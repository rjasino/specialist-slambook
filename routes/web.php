<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SlamBookController;
use App\Models\SlamBook;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        $slambook = SlamBook::where('user_id', Auth::id())->first();
        return view('dashboard', ['slambook' => $slambook]);
    }
    return redirect()->route('auth.login');
});

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

//protected route
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');

Route::middleware('auth')->group(function () {
    Route::get('/slambook', [SlamBookController::class, 'index'])->name('slambook.start');
    Route::get('/slambook/step/{step}', [SlamBookController::class, 'showStep'])->name('slambook.step');
    Route::post('/slambook/process', [SlamBookController::class, 'processStep'])->name('slambook.process');

    Route::get('/slambook/{id}/edit', [SlamBookController::class, 'edit'])->name('slambook.edit');
    Route::put('/slambook/{id}', [SlamBookController::class, 'update'])->name('slambook.update');

    Route::delete('/slambook/{id}', [SlamBookController::class, 'destroy'])->name('slambook.destroy');
});
