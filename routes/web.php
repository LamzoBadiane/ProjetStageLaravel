<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentProfileController;


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
    Route::view('/etudiant/dashboard', 'etudiant.dashboard')->name('etudiant.dashboard');
    Route::view('/etudiant/dashboard', 'etudiant.dashboard')->middleware('auth');
    Route::view('/entreprise/dashboard', 'entreprise.dashboard')->middleware('auth');
    Route::view('/admin/dashboard', 'admin.dashboard')->middleware('auth');
    Route::get('/etudiant/profile', [StudentProfileController::class, 'edit'])->name('etudiant.profile.edit');
    Route::post('/etudiant/profile', [StudentProfileController::class, 'update'])->name('etudiant.profile.update');
    Route::get('/etudiant/fiche', [StudentProfileController::class, 'show'])->name('etudiant.profile.show');

});

require __DIR__.'/auth.php';
