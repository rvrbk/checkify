<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UnitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/add', [EmployeeController::class, 'add'])->name('employees.add');
    Route::put('/employees/add', [EmployeeController::class, 'put'])->name('employees.put');
    Route::get('/employees/edit/{employee}', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::patch('/employees/edit/{employee}', [EmployeeController::class, 'patch'])->name('employees.patch');

    Route::get('/units', [UnitController::class, 'index'])->name('units.index');
    Route::get('/units/add', [UnitController::class, 'add'])->name('units.add');
    Route::put('/units/add', [UnitController::class, 'put'])->name('units.put');
    Route::get('/units/edit/{unit}', [UnitController::class, 'edit'])->name('units.edit');
    Route::patch('/units/edit/{unit}', [UnitController::class, 'patch'])->name('units.patch');
    Route::get('/units/pdf/{unit}', [UnitController::class, 'pdf'])->name('units.pdf');
});

require __DIR__ . '/auth.php';
