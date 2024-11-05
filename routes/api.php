<?php

use App\Http\Controllers\WorkspaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/users', [WorkspaceController::class, 'user']);

Route::get('/workspaces', [WorkspaceController::class, 'index']);