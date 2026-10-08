<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cc', function () {
    return view('dashboard.admincopy');
});



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


                        /******************** TICKETS  /********************/
Route::get('/tickets', [TicketController::class, 'index'])->middleware(['auth', 'verified'])->name('tickets.index');

Route::get('/tickets/create', [TicketController::class, 'create'])->middleware(['auth', 'verified'])->name('tickets.create');
Route::post('/tickets', [TicketController::class, 'store'])->middleware(['auth', 'verified'])->name('tickets.store');

Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit']) ->middleware(['auth', 'verified'])->name('tickets.edit');
Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->middleware(['auth', 'verified'])->name('tickets.update');

Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->middleware(['auth', 'verified'])->name('tickets.destroy');



                        /******************** Categories  /********************/
Route::get('/categories', [CategoryController::class, 'index'])->middleware(['auth', 'verified'])->name('categories.index');

Route::get('/categories/create', [CategoryController::class, 'create'])->middleware(['auth', 'verified'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->middleware(['auth', 'verified'])->name('categories.store');

Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']) ->middleware(['auth', 'verified'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->middleware(['auth', 'verified'])->name('categories.update');

Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->middleware(['auth', 'verified'])->name('categories.destroy');
                       /********* SHOW Details et attachements ************/



                        /******************** Labels  /********************/
Route::get('/labels', [LabelController::class, 'index'])->middleware(['auth', 'verified'])->name('labels.index');

Route::get('/labels/create', [LabelController::class, 'create'])->middleware(['auth', 'verified'])->name('labels.create');
Route::post('/labels', [LabelController::class, 'store'])->middleware(['auth', 'verified'])->name('labels.store');

Route::get('/labels/{label}/edit', [LabelController::class, 'edit']) ->middleware(['auth', 'verified'])->name('labels.edit');
Route::put('/labels/{label}', [LabelController::class, 'update'])->middleware(['auth', 'verified'])->name('labels.update');

Route::delete('/labels/{label}', [LabelController::class, 'destroy'])->middleware(['auth', 'verified'])->name('labels.destroy');




                        /******************** Logs  /********************/
Route::get('/logs', [LogController::class, 'index'])->middleware(['auth', 'verified'])->name('logs.index');


                        /******************** Users  /********************/

Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->middleware(['auth', 'verified'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->middleware(['auth', 'verified'])->name('users.store');


Route::get('/users/{user}/edit', [UserController::class, 'edit']) ->middleware(['auth', 'verified'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('users.update');

Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware(['auth', 'verified'])->name('users.destroy');






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
