<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $users = User::where('approved', 0)->latest()->paginate(10);
    return view('dashboard', [
        'users' => $users
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/approve/{user}', [ProfileController::class, 'approve'])->name('profile.approve');
    Route::put('/update-information', [ProfileController::class, 'updateInformation'])->name('profile.personal-information.update');
    Route::get('/user/create', [UserController::class, 'createUser'])->name('create-user.view');
    Route::post('/user/store', [UserController::class, 'storeUser'])->name('user.store');

});

require __DIR__.'/auth.php';
