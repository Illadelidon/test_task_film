<?php

namespace App\Http\Controllers;

use App\Services\GenreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    protected $genreService;

    // Ініціалізація сервісу
    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }

    // Отримання всіх жанрів
    public function index()
    {
        $genres = $this->genreService->getAllGenres();
        return response()->json($genres, 200);
    }
    public function getMoviesByGenre($id, Request $request)
    {
        $perPage = $request->query('perPage', 2); // Кількість на сторінку (за замовчуванням 2)
        $movies = $this->genreService->getMoviesByGenre($id, $perPage);

        return response()->json($movies, 200);
    }

    // Створення жанра
    public function store(Request $request)
    {
        $genre = $this->genreService->createGenre($request);
        return response()->json($genre, 201);
    }

    // Оновлення жанра
    public function update(Request $request, $id)
    {
        $genre = $this->genreService->updateGenre($request, $id);
        return response()->json($genre, 200);
    }

    // Видалення жанра
    public function destroy($id)
    {
        $response = $this->genreService->deleteGenre($id);
        return response()->json($response, 200);
    }
}
