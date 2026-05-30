<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index()
    {
        $about = DB::table('abouts')->latest()->first();

        $projects = DB::table('projects')->orderBy('created_at','desc')->get();

        $services = DB::table('services')->orderBy('id')->get();
        $experiences = DB::table('experiences')->orderBy('id')->get();
        $certificates = DB::table('certificates')->orderBy('id')->get();
        $links = DB::table('links')->orderBy('id')->get();
        $about_features = DB::table('about_features')->orderBy('sort')->get();
        $chats = DB::table('chats')->orderBy('created_at','desc')->limit(50)->get();
        $notifications = DB::table('notifications')->where('is_read', false)->get();
        $settings = DB::table('settings')->first();

        // Get tech stacks
        $tech_stacks = DB::table('tech_stacks')->where('is_active', true)->orderBy('sort')->get();

        // Get portfolio images
        $portfolio_images = DB::table('portfolio_images')->where('is_active', true)->orderBy('sort')->get();
        
        // Get hero and about images
        $heroImage = $portfolio_images->where('type', 'hero')->first();
        $aboutImage = $portfolio_images->where('type', 'about')->first();
        $galleryImages = $portfolio_images->where('type', 'gallery')->values();

        // Get active CV
        $activeCv = DB::table('cvs')->where('is_active', true)->first();
        $cvUrl = null;
        if ($activeCv && $activeCv->file_path) {
            $cvUrl = asset('storage/' . $activeCv->file_path);
        }

        // Skill categories and items (for the Skills section)
        $skill_categories = DB::table('skill_categories')->orderBy('sort')->get();
        foreach ($skill_categories as $c) {
            $c->items = DB::table('skill_items')->where('category_id', $c->id)->orderBy('sort')->get();
        }

        // Counts for stats (used in the hero stats section)
        $projects_count = DB::table('projects')->count();
        $services_count = DB::table('services')->count();
        $experiences_count = DB::table('experiences')->count();
        $certificates_count = DB::table('certificates')->count();
        $links_count = DB::table('links')->count();
        $unread_notifications = DB::table('notifications')->where('is_read', false)->count();

          ///   فك بينري الصور  ///
         foreach ($projects as $project) {
            if ($project->image) {
                $project->image = 'data:image/jpeg;base64,' . base64_encode($project->image);
            } else {
                $project->image = 'https://via.placeholder.com/400x300';
            }
        }

        return view('site.index', compact(
            'about','projects','services','experiences','certificates','links','about_features','chats','notifications','skill_categories',
            'projects_count','services_count','experiences_count','certificates_count','links_count','unread_notifications','settings',
            'cvUrl','tech_stacks','heroImage','aboutImage','galleryImages'
        ));
    }
    public function select_project($id)
{
    $project = DB::table('projects')->where('id',$id)->first();

    return response()->json($project);
}
}
