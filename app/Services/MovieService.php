<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    // Метод для створення фільму
    public function store(Request $request)
    {
        // Валідація вхідних даних
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable',
            'genre_ids' => 'nullable|array',
            'genre_ids.*' => 'exists:genres,id',
        ]);
        $poster = $request->file('poster');
        // Завантаження постера
        $posterPath = $request->hasFile('poster')
            ? $request->file('poster')->store('posters', 'public')
            : 'posters/default_poster.jpg';

        // Створення нового фільму
        $movie = Movie::create([
            'title' => $validated['title'],
            'poster_url' => $posterPath,
            'is_published' => false,
        ]);

        // Прив'язка жанрів
        if ($request->genre_ids) {
            $movie->genres()->sync($request->genre_ids);
        }

        return response()->json(['movie' => $movie], 201);
    }



    // Метод для оновлення фільму
    public function updateMovie(Request $request, Movie $movie)
    {
        // Завантаження нового постера
        if ($request->hasFile('poster')) {
            // Видалення старого файлу, якщо він не дефолтний
            if ($movie->poster_url && $movie->poster_url !== 'posters/default_poster.jpg') {
                Storage::disk('public')->delete($movie->poster_url);
            }
            // Збереження нового постера
            $movie->poster_url = $request->file('poster')->store('posters', 'public');
        }

        // Оновлення назви фільму
        $movie->update($request->only(['title']));

        // Оновлення жанрів
        if ($request->genre_ids) {
            $movie->genres()->sync($request->genre_ids);
        }

        return $movie;
    }

    // Видалення фільму
    public function deleteMovie(Movie $movie)
    {
        // Видалення постера, якщо він не дефолтний
        if ($movie->poster_url && $movie->poster_url !== 'posters/default_poster.jpg') {
            Storage::disk('public')->delete($movie->poster_url);
        }

        // Видалення фільму
        $movie->delete();

        return true;
    }

    // Публікація фільму
    public function publishMovie(Movie $movie)
    {
        $movie->update(['is_published' => true]);

        return $movie;
    }

    // Отримання всіх фільмів з жанрами
    public function getAllMovies($perPage = 2)
    {
        return Movie::with('genres')->paginate($perPage);
    }

    public function getMovieById($id)
    {
        return Movie::with('genres')->findOrFail($id);
    }
}
