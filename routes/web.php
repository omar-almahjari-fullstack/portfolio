<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\MailController;

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/login', function () { return view('auth.login'); })->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/check-auth', [AuthController::class, 'checkAuth'])->name('check.auth');

// Google OAuth
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Contact form
Route::post('/contact/send', [MailController::class, 'sendContact'])->name('contact.send');

// Chat routes - public can view and send
Route::get('/chat/messages', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/send', [ChatController::class, 'store'])->name('chat.send');

Route::middleware('auth')->group(function () {
    // User messages
    Route::get('/chat/my-messages', [ChatController::class, 'getUserMessages'])->name('chat.my-messages');
    
    // Admin only routes
    Route::middleware('admin')->group(function () {
        Route::get('/chat/conversations', [ChatController::class, 'getConversations'])->name('chat.conversations');
        Route::get('/chat/conversation/{userId}', [ChatController::class, 'getConversationMessages'])->name('chat.conversation');
        Route::post('/chat/conversation/{userId}/reply', [ChatController::class, 'adminReply'])->name('chat.reply');
        Route::post('/chat/conversation/{userId}/read', [ChatController::class, 'markAsRead'])->name('chat.read');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/category/store', [DashboardController::class, 'storeCategory'])->name('skills.category.store');
    Route::post('/category/update/{id}', [DashboardController::class, 'updateCategory'])->name('skills.category.update');
    Route::delete('/category/delete/{id}', [DashboardController::class, 'deleteCategory'])->name('skills.category.delete');

    Route::post('/item/store', [DashboardController::class, 'storeItem'])->name('skills.item.store');
    Route::post('/item/update/{id}', [DashboardController::class, 'updateItem'])->name('skills.item.update');
    Route::delete('/item/delete/{id}', [DashboardController::class, 'deleteItem'])->name('skills.item.delete');

    Route::post('/project/store', [DashboardController::class, 'projectstore'])->name('project_store');
    Route::delete('/project/delete/{id}', [DashboardController::class, 'projectdelete'])->name('project_delete');
    Route::get('/project/edit/{id}', [DashboardController::class, 'edit_record_btn'])->name('project_edit');
    Route::post('/project/update/{id}', [DashboardController::class, 'projectupdate'])->name('project_update');

    Route::post('/service/store', [DashboardController::class, 'serveice_store'])->name('service_store');
    Route::delete('/service/delete/{id}', [DashboardController::class, 'servicedelete'])->name('service_delete');
    Route::get('/service/edit/{id}', [DashboardController::class, 'serviceedit'])->name('service_edit');
    Route::post('/service/update/{id}', [DashboardController::class, 'serviceupdate'])->name('service_update');

    Route::post('/profile/update', [DashboardController::class, 'addorupdate'])->name('profile.update');

    Route::post('/settings/update', [DashboardController::class, 'settingsUpdate'])->name('settings.update');

    Route::get('/edit_record_btn/{id}', [DashboardController::class, 'edit_record_btn'])->name('edit_record_btn');

    // Experiences CRUD
    Route::post('/experience/store', [DashboardController::class, 'experienceStore'])->name('experience.store');
    Route::get('/experience/edit/{id}', [DashboardController::class, 'experienceEdit'])->name('experience.edit');
    Route::post('/experience/update/{id}', [DashboardController::class, 'experienceUpdate'])->name('experience.update');
    Route::delete('/experience/delete/{id}', [DashboardController::class, 'experienceDelete'])->name('experience.delete');

    // Certificates CRUD
    Route::post('/certificate/store', [DashboardController::class, 'certificateStore'])->name('certificate.store');
    Route::get('/certificate/edit/{id}', [DashboardController::class, 'certificateEdit'])->name('certificate.edit');
    Route::post('/certificate/update/{id}', [DashboardController::class, 'certificateUpdate'])->name('certificate.update');
    Route::delete('/certificate/delete/{id}', [DashboardController::class, 'certificateDelete'])->name('certificate.delete');

    // CV CRUD
    Route::post('/cv/store', [DashboardController::class, 'cvStore'])->name('cv.store');
    Route::get('/cv/edit/{id}', [DashboardController::class, 'cvEdit'])->name('cv.edit');
    Route::post('/cv/update/{id}', [DashboardController::class, 'cvUpdate'])->name('cv.update');
    Route::delete('/cv/delete/{id}', [DashboardController::class, 'cvDelete'])->name('cv.delete');
    Route::get('/cv/set-active/{id}', [DashboardController::class, 'cvSetActive'])->name('cv.set-active');

    // Public CV download route
    Route::get('/cv/download', [DashboardController::class, 'getActiveCV'])->name('cv.download');

    // Tech Stack CRUD
    Route::post('/tech-stack/store', [DashboardController::class, 'techStackStore'])->name('tech-stack.store');
    Route::get('/tech-stack/edit/{id}', [DashboardController::class, 'techStackEdit'])->name('tech-stack.edit');
    Route::post('/tech-stack/update/{id}', [DashboardController::class, 'techStackUpdate'])->name('tech-stack.update');
    Route::delete('/tech-stack/delete/{id}', [DashboardController::class, 'techStackDelete'])->name('tech-stack.delete');
    Route::get('/tech-stack/toggle/{id}', [DashboardController::class, 'techStackToggleActive'])->name('tech-stack.toggle');

    // Portfolio Images CRUD
    Route::post('/portfolio-image/store', [DashboardController::class, 'portfolioImageStore'])->name('portfolio-image.store');
    Route::get('/portfolio-image/edit/{id}', [DashboardController::class, 'portfolioImageEdit'])->name('portfolio-image.edit');
    Route::post('/portfolio-image/update/{id}', [DashboardController::class, 'portfolioImageUpdate'])->name('portfolio-image.update');
    Route::delete('/portfolio-image/delete/{id}', [DashboardController::class, 'portfolioImageDelete'])->name('portfolio-image.delete');
    Route::get('/portfolio-image/set-active/{id}', [DashboardController::class, 'portfolioImageSetActive'])->name('portfolio-image.set-active');

    Route::get('/select_project/{id}', [SiteController::class, 'select_project']);
});
