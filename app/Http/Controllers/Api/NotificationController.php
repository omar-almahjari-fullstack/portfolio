<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        return response()->json(DB::table('notifications')->orderBy('created_at','desc')->get());
    }

    public function store(Request $request)
    {
        $id = DB::table('notifications')->insertGetId([
            'user_id' => $request->input('user_id'),
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(DB::table('notifications')->where('id', $id)->first());
    }

    public function markRead($id)
    {
        DB::table('notifications')->where('id', $id)->update(['is_read' => true, 'updated_at' => now()]);
        return response()->json(['ok' => true]);
    }
}
