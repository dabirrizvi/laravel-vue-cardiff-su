<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Define routes for tasks
Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']); // Fetch all tasks
    Route::post('/', [TaskController::class, 'store']); // Store a new task
    Route::put('/{task}', [TaskController::class, 'update']); // Update an existing task
    Route::delete('/{task}', [TaskController::class, 'destroy']); // Delete an existing task
});
