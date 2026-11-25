<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/services', [SiteController::class, 'services'])->name('services.index');
Route::get('/services/{service}', [SiteController::class, 'serviceShow'])->name('services.show');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog.index');
Route::get('/blog/{post}', [SiteController::class, 'blogShow'])->name('blog.show');
Route::get('/knowledge', [SiteController::class, 'knowledge'])->name('kb.index');
Route::get('/knowledge/{article}', [SiteController::class, 'knowledgeShow'])->name('kb.show');
Route::post('/api/chat', ChatController::class)->name('chat');
