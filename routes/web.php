<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [EmployeeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//showing an employee
Route::get('/employee/search', [EmployeeController::class, 'show'])
->middleware(['auth', 'verified'])
->name('employee.search');


//showing the add form
Route::get('/add', [EmployeeController::class, 'create'])
->middleware(['auth', 'verified'])
->name('add');


//adding an employee
Route::post('/add', [EmployeeController::class, 'store'])
->middleware(['auth', 'verified'])
->name('employee.store');


//showing the edit page
Route::get('/edit/{employee}', [EmployeeController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('employee.edit');


//updating an employee
Route::put('/edit/{employee}', [EmployeeController::class, 'update'])
->middleware(['auth', 'verified'])
->name('employee.update');


//deleting an employee
Route::delete('/dashboard/{employee}', [EmployeeController::class, 'destroy'])
->middleware(['auth', 'verified'])
->name('employee.destroy');


require __DIR__.'/auth.php';