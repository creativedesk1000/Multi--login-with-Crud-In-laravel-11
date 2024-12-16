<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\User;


Route::get('/', function () {
    return redirect('/login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);




Route::get('/admin/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        $users = User::where('role', 'user')->get(); // Fetch users with 'user' role
        return view('admin.dashboard', compact('users')); // Pass the data to the view
    }
    abort(403, 'Unauthorized access.');
});
Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');








Route::get('/user/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'user') {
        return view('user.dashboard');
    }
    abort(403, 'Unauthorized access.');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);