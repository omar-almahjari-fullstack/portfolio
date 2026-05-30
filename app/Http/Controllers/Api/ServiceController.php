<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json(DB::table('services')->orderBy('id')->get());
    }

    public function store(Request $request)
    {
        $id = DB::table('services')->insertGetId([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'icon' => $request->input('icon'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(DB::table('services')->where('id', $id)->first());
    }

    public function update(Request $request, $id)
    {
        DB::table('services')->where('id', $id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'icon' => $request->input('icon'),
            'updated_at' => now(),
        ]);
        return response()->json(['ok' => true]);
    }

    public function destroy($id)
    {
        DB::table('services')->where('id', $id)->delete();
        return response()->json(['ok' => true]);
    }
}
