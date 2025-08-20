<?php

use App\Http\Controllers\Api\StoryController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/admin');

Route::apiResource('api/stories', StoryController::class)->except(['store', 'create', 'update', 'edit', 'delete']);
