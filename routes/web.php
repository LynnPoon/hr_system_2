<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






// Admin route
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
  // Admin view
  return view('admin.dashboard');
})->name('admin.dashboard');

// Employee route
Route::middleware(['auth', 'role:employee'])->get('/employee/dashboard', function () {
  // Employee view
  return view('employees.index');
})->name('employee.dashboard');





require __DIR__.'/auth.php';
