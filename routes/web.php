<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
return view('welcome');
});

Route::get('/about', function () {
return view('about');
});

route::get('/login', [AuthController::class, 
'showLoginForm']) -> name('login');

route::post('/login', [AuthController::class, 'login']);

route::get('/register', [AuthController::class, 
'showRegisterForm']) -> name('register');

route::post('/register', [AuthController::class, 'register']);

route::post('/logout', [AuthController::class, 'logout']) -> name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'role:admin|hr'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard'); 
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:job_seeker'])->group(function () {
    Route::get('/jobseeker/dashboard', function () {
        return view('dashboard'); 
    })->name('jobseeker.dashboard');
});

Route::get('/hello', function () {
    return "Halo, ini halaman percobaan route!";
});

Route::get('/jobs', [JobController::class, 'index']);

Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware(['auth']);

// Route::get('/admin', function () {
//     return "Halaman Admin:";
// })  -> middleware(['auth', 'isAdmin']);

// Route::get('/admin', function () {
//     return "Hello Admin!";
// }) -> middleware(['auth', 'isAdmin']);

// Latihan 1: Route /profile hanya bisa diakses oleh user yang sudah login
Route::get('/profile', function () {
    return "Ini Halaman Profile Kamu, Selamat Datang " . Auth::user()->name; 
})->middleware(['auth']);

// Latihan 2: Route /admin/jobs hanya bisa diakses oleh admin
Route::get('/admin/jobs', function () {
    return "Halaman Admin: blahblah(Hanya Admin yang Bisa Lihat)";
})->middleware(['auth', 'isAdmin']);       

// hanya Admin yang bisa mengelola lowongan kerja.
Route::resource('jobs',
JobController::class)->middleware(['auth', 'isAdmin']);