<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(DB::table('projects')->orderBy('created_at','desc')->get());
    }

    public function store(Request $request)
    {
        $id = DB::table('projects')->insertGetId([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $request->input('image'),
            'url' => $request->input('url'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        DB::table('projects')->where('id', $id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $request->input('image'),
            'url' => $request->input('url'),
            'updated_at' => now(),
        ]);

        return response()->json(['ok' => true]);
    }

    public function destroy($id)
    {
        DB::table('projects')->where('id', $id)->delete();
        return response()->json(['ok' => true]);
    }
}
