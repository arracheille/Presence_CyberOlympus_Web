<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/workspaces', [WorkspaceController::class, 'index']);
// });

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/workspaces', [WorkspaceController::class, 'index']);
});
