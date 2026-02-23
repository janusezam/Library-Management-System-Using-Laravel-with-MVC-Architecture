<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', static fn () => redirect()->route('dashboard'));

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('students', StudentController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('books', BookController::class);

    // Borrow routes
    Route::get('/borrows', [BorrowController::class, 'index'])->name('borrows.index');
    Route::get('/borrows/create', [BorrowController::class, 'create'])->name('borrows.create');
    Route::post('/borrows', [BorrowController::class, 'store'])->name('borrows.store');
    Route::get('/borrows/overdue', [BorrowController::class, 'overdue'])->name('borrows.overdue');
    Route::get('/borrows/{borrow}', [BorrowController::class, 'show'])->name('borrows.show');
    Route::post('/borrows/{borrow}/return', [BorrowController::class, 'returnBooks'])->name('borrows.return');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
