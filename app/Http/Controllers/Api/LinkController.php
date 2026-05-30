<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    public function index()
    {
        return response()->json(DB::table('links')->orderBy('id')->get());
    }

    public function store(Request $request)
    {
        $id = DB::table('links')->insertGetId([
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'icon' => $request->input('icon'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(DB::table('links')->where('id', $id)->first());
    }

    public function update(Request $request, $id)
    {
        DB::table('links')->where('id', $id)->update([
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'icon' => $request->input('icon'),
            'updated_at' => now(),
        ]);
        return response()->json(['ok' => true]);
    }

    public function destroy($id)
    {
        DB::table('links')->where('id', $id)->delete();
        return response()->json(['ok' => true]);
    }
}
