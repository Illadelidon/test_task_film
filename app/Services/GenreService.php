<?php

namespace App\Services;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class GenreService
{
    public function getAllGenres()
    {
        $genres = Genre::all();
        return response()->json(['genres' => $genres], 200);
    }


    // Вивід фільмів за жанром із пагінацією
    public function getMoviesByGenre($id, $perPage )
    {
        // Отримання жанру з фільмами
        $genre = Genre::with('movies')->findOrFail($id);

        // Пагінація фільмів для цього жанру
        return $genre->movies()->paginate($perPage);
    }




    // Створення нового жанра
    public function createGenre(Request $request)
    {
        // Валідація
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Створення жанра
        $genre = Genre::create([
            'name' => $validated['name'],
        ]);

        return $genre;
    }

    // Оновлення жанра
    public function updateGenre(Request $request, $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            throw new ModelNotFoundException('Genre not found');
        }

        // Валідація
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Оновлення жанра
        $genre->update([
            'name' => $validated['name'],
        ]);

        return $genre;
    }

    // Видалення жанра
    public function deleteGenre($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            throw new ModelNotFoundException('Genre not found');
        }

        // Видалення жанра
        $genre->delete();

        return ['message' => 'Genre deleted successfully'];
    }
}
