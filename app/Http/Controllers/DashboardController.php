<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = DB::table('projects')->orderBy('created_at','desc')->get();
        $about = DB::table('abouts')->first();
        $services = DB::table('services')->orderBy('id')->get();
        $experiences = DB::table('experiences')->orderBy('id')->get();
        $certificates = DB::table('certificates')->orderBy('id')->get();
        $cvs = DB::table('cvs')->orderBy('created_at','desc')->get();
        $tech_stacks = DB::table('tech_stacks')->orderBy('sort')->get();
        $portfolio_images = DB::table('portfolio_images')->orderBy('type')->orderBy('sort')->get();
        $links = DB::table('links')->orderBy('id')->get();
        $chats = DB::table('chats')->orderBy('created_at','desc')->limit(50)->get();
        $notifications = DB::table('notifications')->orderBy('created_at','desc')->get();

        $settings = DB::table('settings')->first();

        // Skill categories and items (for the Skills section)
        $skill_categories = DB::table('skill_categories')->orderBy('sort')->get();
        foreach ($skill_categories as $c) {
            $c->items = DB::table('skill_items')->where('category_id', $c->id)->orderBy('sort')->get();
        }

        // Real statistics for dashboard overview
        $stats = [
            'projects_count' => DB::table('projects')->count(),
            'services_count' => DB::table('services')->count(),
            'messages_count' => DB::table('chats')->select('user_id')->distinct()->count(),
            'technologies_count' => DB::table('tech_stacks')->count(),
            'experiences_count' => DB::table('experiences')->count(),
            'certificates_count' => DB::table('certificates')->count(),
            'views_count' => 0,
            'unread_messages' => DB::table('chats')->where('is_read', false)->count(),
            'total_images' => DB::table('portfolio_images')->count(),
            'active_images' => DB::table('portfolio_images')->where('is_active', true)->count(),
            'unread_notifications' => DB::table('notifications')->where('is_read', false)->count(),
        ];

        // Chat stats
        $conversations = DB::table('chats')
            ->select('user_id', DB::raw('count(*) as message_count'))
            ->groupBy('user_id')
            ->get();
        $stats['conversations_count'] = $conversations->count();

        // Categories distribution for projects chart
        $stats['project_categories'] = DB::table('projects')
            ->select('categorie_project', DB::raw('count(*) as total'))
            ->groupBy('categorie_project')
            ->get();

        return view('dashboard.dashboard', compact('projects','services','experiences','certificates','cvs','tech_stacks','portfolio_images','links','chats','notifications','about','skill_categories','settings', 'stats'));
    }

    public function addorupdate(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string|max:2000',
        ]);


        if($request->hasFile('image')){
            $image = file_get_contents($request->file('image')->getRealpath());
        }else{
            $image = null;
        }

       DB::table('abouts')->updateOrInsert(
            ['id' => 1], // يبحث عن الصف رقم 1
            [
                'name' => $request->name,
                'bio'  => $request->bio,
                'image' => $image,
                'description' => $request->description
            ]
        );

        return redirect()->route('dashboard')->with('success', 'تم تحديث الملف الشخصي بنجاح.');
    }

    public function settingsUpdate(Request $request){
        $request->validate([
            'site_title' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'site_keywords' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'github' => 'nullable|url',
        ]);

        $data = [
            'site_title' => $request->site_title,
            'site_description' => $request->site_description,
            'site_keywords' => $request->site_keywords,
            'contact_email' => $request->contact_email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'github' => $request->github,
            'updated_at' => now(),
        ];

        DB::table('settings')->updateOrInsert(
            ['id' => 1],
            $data
        );

        return redirect()->back()->with('success', 'تم حفظ الإعدادات بنجاح.');
    }

    public function storeCategory(Request $request){
        $request->validate([
          'title'=>'string|required',
        ]);

        DB::table('skill_categories')->insert([
            'title'=>$request->title,
            'created_at'=>now(),
        ]);

        $data = DB::table('skill_categories')->get();

        return redirect()->back()->with('success', 'تمت إضافة الفئة بنجاح');
    }

    public function updateCategory(Request $request, $id){
        $request->validate([
            'title'=>'string|required',
        ]);

        DB::table('skill_categories')->where('id', $id)->update([
            'title'=>$request->title,
            'updated_at'=>now(),
        ]);

        return redirect()->back()->with('success', 'تم تحديث الفئة بنجاح');
    }

    public function storeItem(Request $request){
        $request->validate([
            'name'=>'required|string'
        ]);
        DB::table('skill_items')->insert([
            'name'=>$request->name,
            'level'=>$request->level ?? 0,
            'category_id'=>$request->id,
            'created_at'=>now(),
        ]);

        return redirect()->back()->with('success', 'تمت إضافة العنصر بنجاح');
    }

    public function updateItem(Request $request, $id){
        $request->validate([
            'name'=>'required|string',
            'level'=>'nullable|integer|min:0|max:100'
        ]);

        DB::table('skill_items')->where('id', $id)->update([
            'name'=>$request->name,
            'level'=>$request->level ?? 0,
            'updated_at'=>now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'تم تحديث المهارة بنجاح'
        ]);
    }
    public function deleteCategory($id){
        DB::table('skill_categories')->where('id',$id)->delete();
        DB::table('skill_items')->where('category_id',$id)->delete();

        return redirect()->back()->with('success', 'تم حذف الفئة وجميع عناصرها بنجاح');
    }

    public function deleteItem($id){
        DB::table('skill_items')->where('id',$id)->delete();

         return response()->json([
        'status' => true,
        'message' => 'تم حذف المهارة بنجاح',
        'id' => $id
        ]);
    }

    public function projectstore(Request $request){
        $request->validate([
            'title'=>'Required|string',
            'description'=>'Required|string',
            'image'=>'nullable|image',
            'categorie_project'=>'Required|string',
            'url'=>'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            $image = file_get_contents($request->file('image')->getRealPath());
        } else {
            $image = null;
        }

        DB::table('projects')->insert([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=> $image,
            'categorie_project'=> $request->categorie_project,
            'url'=>$request->url
        ]);

        return redirect()->back()->with('success','تم الاضافة بنجاح');

    }

    public function projectdelete($id){
        DB::table('projects')->where('id',$id)->delete();

      return response()->json([
        'status' => true,
        'message' => 'تم حذف المشروع بنجاح بنجاح',
        'id' => $id
        ]);
    }

    public function edit_record_btn($id){

        $projects = DB::table('projects')->find($id);

        if (!empty($projects->image)) {
            $projects->image = 'data:image/jpeg;base64,' . base64_encode($projects->image);
        }

            if (!$projects) {
            return response()->json([
                'status' => false,
                'message' => 'السجل غير موجود'
            ], 404);
        }
            return response()->json([
                'status' => true,
                'data' => $projects
            ]);
    }
    public function serveice_store(Request $request){
        $request->validate([
            'title'=>'string|Required',
            'description'=>'Required|string',
            'icon'=>'string',
        ]);

        DB::table('services')->insert([
            'title'=>$request->title,
            'description'=>$request->description,
            'icon'=>$request->icon,
            'created_at'=>now()
        ]);

         return redirect()->back()->with('success', 'تمت إضافة العنصر بنجاح');

    }

    public function servicedelete($id){
        DB::table('services')->where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف الخدمة بنجاح',
            'id' => $id
        ]);
    }

    public function serviceedit($id){
        $service = DB::table('services')->find($id);
        if (!$service) {
            return response()->json([
                'status' => false,
                'message' => 'الخدمة غير موجودة'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $service
        ]);
    }

    public function serviceupdate(Request $request, $id){
        $request->validate([
            'title'=>'string|Required',
            'description'=>'Required|string',
            'icon'=>'string',
        ]);

        DB::table('services')->where('id', $id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'icon'=>$request->icon,
            'updated_at'=>now()
        ]);

        return redirect()->back()->with('success', 'تم تحديث الخدمة بنجاح');
    }

    public function projectupdate(Request $request, $id){
        $request->validate([
            'title'=>'Required|string',
            'description'=>'Required|string',
            'categorie_project'=>'Required|string',
            'url'=>'nullable|string'
        ]);

        $data = [
            'title'=>$request->title,
            'description'=>$request->description,
            'categorie_project'=>$request->categorie_project,
            'url'=>$request->url,
            'updated_at'=>now()
        ];

        if ($request->hasFile('image')) {
            $data['image'] = file_get_contents($request->file('image')->getRealPath());
        }

        DB::table('projects')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'تم تحديث المشروع بنجاح');
    }

    // ==================== EXPERIENCES CRUD ====================
    
    public function experienceStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        DB::table('experiences')->insert([
            'title' => $request->title,
            'company' => $request->company,
            'duration' => $request->duration,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تمت إضافة الخبرة بنجاح');
    }

    public function experienceEdit($id)
    {
        $experience = DB::table('experiences')->find($id);
        if (!$experience) {
            return response()->json([
                'status' => false,
                'message' => 'الخبرة غير موجودة'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $experience
        ]);
    }

    public function experienceUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        DB::table('experiences')->where('id', $id)->update([
            'title' => $request->title,
            'company' => $request->company,
            'duration' => $request->duration,
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تم تحديث الخبرة بنجاح');
    }

    public function experienceDelete($id)
    {
        DB::table('experiences')->where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف الخبرة بنجاح',
            'id' => $id
        ]);
    }

    // ==================== CERTIFICATES CRUD ====================

    public function certificateStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = $file->store('certificates', 'public');
        }

        DB::table('certificates')->insert([
            'title' => $request->title,
            'issuer' => $request->issuer,
            'year' => $request->year,
            'image' => $imagePath,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تمت إضافة الشهادة بنجاح');
    }

    public function certificateEdit($id)
    {
        $certificate = DB::table('certificates')->find($id);
        if (!$certificate) {
            return response()->json([
                'status' => false,
                'message' => 'الشهادة غير موجودة'
            ], 404);
        }
        if ($certificate->image) {
            $certificate->image_url = asset('storage/' . $certificate->image);
        }
        return response()->json([
            'status' => true,
            'data' => $certificate
        ]);
    }

    public function certificateUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = [
            'title' => $request->title,
            'issuer' => $request->issuer,
            'year' => $request->year,
            'description' => $request->description,
            'updated_at' => now(),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('certificates', 'public');
        }

        DB::table('certificates')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'تم تحديث الشهادة بنجاح');
    }

    public function certificateDelete($id)
    {
        DB::table('certificates')->where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف الشهادة بنجاح',
            'id' => $id
        ]);
    }

    // ==================== CV CRUD ====================

    public function cvStore(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:5120',
            'name' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('cvs', 'public');
            
            // Deactivate all other CVs
            DB::table('cvs')->update(['is_active' => false]);
            
            DB::table('cvs')->insert([
                'name' => $request->name ?? 'CV',
                'file_path' => $filePath,
                'file_name' => $fileName,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'تم رفع السيرة الذاتية بنجاح');
        }

        return redirect()->back()->with('error', 'حدث خطأ في رفع الملف');
    }

    public function cvEdit($id)
    {
        $cv = DB::table('cvs')->find($id);
        if (!$cv) {
            return response()->json([
                'status' => false,
                'message' => 'السيرة الذاتية غير موجودة'
            ], 404);
        }
        if ($cv->file_path) {
            $cv->file_url = asset('storage/' . $cv->file_path);
        }
        return response()->json([
            'status' => true,
            'data' => $cv
        ]);
    }

    public function cvUpdate(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|file|mimes:pdf|max:5120',
            'name' => 'nullable|string|max:255',
        ]);

        $data = [
            'name' => $request->name ?? 'CV',
            'updated_at' => now(),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_path'] = $file->store('cvs', 'public');
        }

        DB::table('cvs')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'تم تحديث السيرة الذاتية بنجاح');
    }

    public function cvDelete($id)
    {
        DB::table('cvs')->where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف السيرة الذاتية بنجاح',
            'id' => $id
        ]);
    }

    public function cvSetActive($id)
    {
        // Deactivate all
        DB::table('cvs')->update(['is_active' => false]);
        // Activate selected
        DB::table('cvs')->where('id', $id)->update(['is_active' => true]);
        
        return redirect()->back()->with('success', 'تم تحديد هذه السيرة الذاتية للنشر');
    }

    public function getActiveCV()
    {
        $cv = DB::table('cvs')->where('is_active', true)->first();
        if ($cv && $cv->file_path) {
            return response()->json([
                'status' => true,
                'data' => [
                    'url' => asset('storage/' . $cv->file_path),
                    'name' => $cv->name
                ]
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'لا توجد سيرة ذاتية متاحة'
        ], 404);
    }

    // ==================== TECH STACK CRUD ====================

    public function techStackStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'sort' => 'nullable|integer',
        ]);

        $maxSort = DB::table('tech_stacks')->max('sort') ?? 0;

        DB::table('tech_stacks')->insert([
            'name' => $request->name,
            'icon' => $request->icon ?? 'fas fa-code',
            'sort' => $request->sort ?? ($maxSort + 1),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تمت إضافة التقنية بنجاح');
    }

    public function techStackEdit($id)
    {
        $tech = DB::table('tech_stacks')->find($id);
        if (!$tech) {
            return response()->json([
                'status' => false,
                'message' => 'التقنية غير موجودة'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $tech
        ]);
    }

    public function techStackUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'sort' => 'nullable|integer',
        ]);

        DB::table('tech_stacks')->where('id', $id)->update([
            'name' => $request->name,
            'icon' => $request->icon ?? 'fas fa-code',
            'sort' => $request->sort ?? 0,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تم تحديث التقنية بنجاح');
    }

    public function techStackDelete($id)
    {
        DB::table('tech_stacks')->where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف التقنية بنجاح',
            'id' => $id
        ]);
    }

    public function techStackToggleActive($id)
    {
        $tech = DB::table('tech_stacks')->find($id);
        if (!$tech) {
            return redirect()->back()->with('error', 'التقنية غير موجودة');
        }
        
        DB::table('tech_stacks')->where('id', $id)->update([
            'is_active' => !$tech->is_active,
            'updated_at' => now(),
        ]);
        
        return redirect()->back()->with('success', 'تم تحديث حالة التقنية بنجاح');
    }

    // ==================== PORTFOLIO IMAGES CRUD ====================

    public function portfolioImageStore(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'type' => 'required|string|in:about,hero,gallery',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $file = $request->file('image');
        $imagePath = $file->store('portfolio', 'public');

        // If type is hero or about, deactivate other images of same type
        if ($request->type !== 'gallery') {
            DB::table('portfolio_images')
                ->where('type', $request->type)
                ->update(['is_active' => false]);
        }

        DB::table('portfolio_images')->insert([
            'type' => $request->type,
            'image_path' => $imagePath,
            'alt_text' => $request->alt_text,
            'is_active' => true,
            'sort' => DB::table('portfolio_images')->max('sort') + 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تم رفع الصورة بنجاح');
    }

    public function portfolioImageEdit($id)
    {
        $image = DB::table('portfolio_images')->find($id);
        if (!$image) {
            return response()->json([
                'status' => false,
                'message' => 'الصورة غير موجودة'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $image
        ]);
    }

    public function portfolioImageUpdate(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $data = [
            'alt_text' => $request->alt_text,
            'updated_at' => now(),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image_path'] = $file->store('portfolio', 'public');
        }

        DB::table('portfolio_images')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'تم تحديث الصورة بنجاح');
    }

    public function portfolioImageDelete($id)
    {
        $image = DB::table('portfolio_images')->find($id);
        if ($image && $image->image_path) {
            \Storage::disk('public')->delete($image->image_path);
        }
        
        DB::table('portfolio_images')->where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'تم حذف الصورة بنجاح',
            'id' => $id
        ]);
    }

    public function portfolioImageSetActive($id)
    {
        $image = DB::table('portfolio_images')->find($id);
        if (!$image) {
            return redirect()->back()->with('error', 'الصورة غير موجودة');
        }

        // Deactivate all images of same type
        DB::table('portfolio_images')
            ->where('type', $image->type)
            ->update(['is_active' => false]);

        // Activate selected image
        DB::table('portfolio_images')
            ->where('id', $id)
            ->update(['is_active' => true, 'updated_at' => now()]);

        return redirect()->back()->with('success', 'تم تحديد الصورة للنشر بنجاح');
    }
}
