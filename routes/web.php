<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProfileController;
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
    return view('admin.welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ------------------------------ ADMIN ROUTES ------------------------------------------
Route::group(['middleware' => ['auth', 'super_admin']], function () {
    Route::get('/admin-dashboard', [HomeController::class, 'getDashboard'])->name('superAdmin-dashboard');

    // ------------------------------ ACTIVITIES ROUTES ------------------------------------------
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities-index');
    Route::get('/activities/new', [ActivityController::class, 'create_view'])->name('activities-create-view');
    Route::get('/activities/edit/{activity}', [ActivityController::class, 'update_view'])->name('activities-update-view');
    Route::post('/activities/create', [ActivityController::class, 'create'])->name('activities-create');
    Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activity-update');
    Route::delete('/activities/{id}', [ActivityController::class, 'delete'])->name('activity-delete');

    // ------------------------------ USERS ROUTES ------------------------------------------

    Route::get('/users', [UserController::class, 'index'])->name('users-index');
    Route::get('/users/{user}', [UserController::class, 'view'])->name('user-view');
    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('user-delete');

    Route::get('/user-activities-list/{user}', [ActivityController::class, 'show'])->name('user-activities');
});

// ------------------------------ USER ROUTES ------------------------------------------
Route::group(['middleware' => ['auth', 'user']], function () {
    Route::get('/user-dashboard', [HomeController::class, 'getDashboard'])->name('user-dashboard');
    Route::get('/user-activities/{user}', [ActivityController::class, 'show'])->name('user-activities-list');
    Route::get('/activities/{activity}', [ActivityController::class, 'view'])->name('activities-view');
});

require __DIR__ . '/auth.php';
