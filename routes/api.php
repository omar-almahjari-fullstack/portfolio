<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\LinkController;
use App\Http\Controllers\Api\NotificationController;

// Public routes
Route::get('/projects', [ProjectController::class, 'index']);

// Notifications
Route::get('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications', [NotificationController::class, 'store']);
Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead']);
