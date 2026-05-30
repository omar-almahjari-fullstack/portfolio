<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExperienceController extends Controller
{
    public function index()
    {
        return response()->json(DB::table('experiences')->orderBy('id')->get());
    }

    public function store(Request $request)
    {
        $id = DB::table('experiences')->insertGetId([
            'title' => $request->input('title'),
            'company' => $request->input('company'),
            'duration' => $request->input('duration'),
            'description' => $request->input('description'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(DB::table('experiences')->where('id', $id)->first());
    }

    public function update(Request $request, $id)
    {
        DB::table('experiences')->where('id', $id)->update([
            'title' => $request->input('title'),
            'company' => $request->input('company'),
            'duration' => $request->input('duration'),
            'description' => $request->input('description'),
            'updated_at' => now(),
        ]);
        return response()->json(['ok' => true]);
    }

    public function destroy($id)
    {
        DB::table('experiences')->where('id', $id)->delete();
        return response()->json(['ok' => true]);
    }
}
