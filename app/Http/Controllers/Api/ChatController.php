<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = DB::table('chats')
            ->orderBy('created_at', 'asc')
            ->limit(200)
            ->get();

        return response()->json($messages);
    }

    public function getUserMessages(Request $request)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $messages = DB::table('chats')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userId = Auth::id();
        $isAdmin = false;

        if ($userId) {
            $user = DB::table('users')->where('id', $userId)->first();
            $isAdmin = $user && isset($user->is_admin) && $user->is_admin;
        }

        $id = DB::table('chats')->insertGetId([
            'user_id' => $userId,
            'message' => $validated['message'],
            'sender_type' => $isAdmin ? 'admin' : 'user',
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $message = DB::table('chats')->where('id', $id)->first();

        return response()->json($message);
    }

    public function adminReply(Request $request, $userId)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'يرجى تسجيل الدخول أولاً'], 401);
        }

        $currentUser = Auth::user();
        if (!($currentUser->is_admin ?? 0) == 1) {
            return response()->json(['error' => 'Forbidden', 'message' => 'غير مصرح لك بالوصول'], 403);
        }

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $id = DB::table('chats')->insertGetId([
            'user_id' => $userId,
            'message' => $validated['message'],
            'sender_type' => 'admin',
            'is_read' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('notifications')->insert([
            'user_id' => $userId,
            'title' => 'رد جديد على رسالتك',
            'body' => $validated['message'],
            'is_read' => false,
            'created_at' => now(),
        ]);

        $message = DB::table('chats')->where('id', $id)->first();
        return response()->json($message);
    }

    public function getConversations()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'يرجى تسجيل الدخول أولاً'], 401);
        }

        $currentUser = Auth::user();
        
        // Check if current user is admin using the model attribute
        if (!$currentUser || !(($currentUser->is_admin ?? 0) == 1)) {
            return response()->json(['error' => 'Forbidden', 'message' => 'غير مصرح لك بالوصول'], 403);
        }

        $users = DB::table('chats')
            ->join('users', 'chats.user_id', '=', 'users.id')
            ->where('chats.user_id', '!=', null)
            ->whereRaw('(users.is_admin IS NULL OR users.is_admin != 1)')
            ->select('users.id', 'users.name', 'users.email', DB::raw('MAX(chats.created_at) as last_message_time'))
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderBy('last_message_time', 'desc')
            ->get();

        foreach ($users as $u) {
            $u->unread_count = DB::table('chats')
                ->where('user_id', $u->id)
                ->where('sender_type', 'admin')
                ->where('is_read', false)
                ->count();

            $lastMessage = DB::table('chats')
                ->where('user_id', $u->id)
                ->orderBy('created_at', 'desc')
                ->first();
            $u->last_message = $lastMessage ? $lastMessage->message : '';
            $u->last_message_time = $lastMessage ? $lastMessage->created_at : null;
        }

        return response()->json($users);
    }

    public function getConversationMessages($userId)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'يرجى تسجيل الدخول أولاً'], 401);
        }

        $currentUser = Auth::user();
        if (!($currentUser->is_admin ?? 0) == 1) {
            return response()->json(['error' => 'Forbidden', 'message' => 'غير مصرح لك بالوصول'], 403);
        }

        DB::table('chats')
            ->where('user_id', $userId)
            ->where('sender_type', 'user')
            ->update(['is_read' => true]);

        $messages = DB::table('chats')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function markAsRead($userId)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'يرجى تسجيل الدخول أولاً'], 401);
        }

        $currentUser = Auth::user();
        if (!($currentUser->is_admin ?? 0) == 1) {
            return response()->json(['error' => 'Forbidden', 'message' => 'غير مصرح لك بالوصول'], 403);
        }

        DB::table('chats')
            ->where('user_id', $userId)
            ->where('sender_type', 'user')
            ->update(['is_read' => true]);

        return response()->json(['status' => true]);
    }
}
