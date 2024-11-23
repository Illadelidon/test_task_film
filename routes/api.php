<?php

use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('movies')->group(function () {
    // Вивести всі фільми
    Route::get('/', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/{id}', [MovieController::class, 'show']);
    // Створити новий фільм
    Route::post('/', [MovieController::class, 'create'])->name('movies.create');
    // Оновити фільм
    Route::put('/{movie}', [MovieController::class, 'update'])->name('movies.update');
    // Видалити фільм
    Route::delete('/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
    // Опублікувати фільм
    Route::patch('/{movie}/publish', [MovieController::class, 'publish'])->name('movies.publish');
}
);
Route::prefix('genres')->group(function () {
    //Вивід всіх фільмів
    Route::get('/', [GenreController::class, 'index']);
    // Вивід фільмів за жанром із пагінацією
    Route::get('/{id}/movies', [GenreController::class, 'getMoviesByGenre']);
    // Вивести всі жанри
    Route::post('/', [GenreController::class, 'store']);
    // Створити новий фільм
    Route::put('/{genres}', [GenreController::class, 'update']);
    // Оновити жанр
    Route::delete('/{genres}', [GenreController::class, 'destroy']);
    // Видалити жанр
}
);
