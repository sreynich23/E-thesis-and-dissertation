<?php

use App\Http\Controllers\CoverController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', [BookController::class, 'index'])->name('book');
Route::get('/book/{id}', [BookController::class, 'show'])->name('books.show');
Route::get('/major/{id}', [BookController::class, 'showMajor'])->name('books.showMajor');

Route::middleware(['auth:student', RoleMiddleware::class . ':student'])->group(function () {
    Route::get('/book/download/{id}', [BookController::class, 'download'])->name('books.download');
});

// Admin Routes (Only for admins)
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/books', [BookController::class, 'indexAdmin'])->name('books');
    Route::post('/books/create', [BookController::class, 'book_Create'])->name('books.create');
    Route::post('/books/update/{id}', [BookController::class, 'updateBook'])->name('books.update');
    Route::post('/majors', [BookController::class, 'create_major'])->name('majors.create');
    Route::post('/books/majors/update/{id}', [BookController::class, 'updateMajor'])->name('majors.edit');
    Route::get('/books/admin', [BookController::class, 'indexAdmin'])->name('books.admin');
    Route::get('/books/{id}', [BookController::class, 'showAdmin'])->name('books.show.admin');
    Route::get('/books/search', [BookController::class, 'searchBooks'])->name('books.search');
    Route::post('/students/store', [StudentController::class, 'create'])->name('students.store');
    Route::post('/cover/store', [CoverController::class, 'store'])->name('covers.store');
    Route::post('/cover/edit/{id}', [CoverController::class, 'edit'])->name('covers.edit');
    Route::delete('/cover/delete/{id}', [CoverController::class, 'destroy'])->name('covers.destroy');
});


