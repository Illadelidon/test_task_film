<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;
class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index(Request $request): JsonResponse
    {
        $movies = $this->movieService->getAllMovies($request->query('per_page', 2));
        return response()->json($movies);
    }
    public function show($id): JsonResponse
    {
        $movie = $this->movieService->getMovieById($id);
        return response()->json($movie);
    }
    public function create(CreateMovieRequest $request): JsonResponse
    {
        $movie = $this->movieService->store($request);
        return response()->json(['message' => 'Movie created successfully', 'movie' => $movie], 201);
    }

    public function update(UpdateMovieRequest $request, Movie $movie): JsonResponse
    {
        $movie = $this->movieService->updateMovie($request, $movie);
        return response()->json(['message' => 'Movie updated successfully', 'movie' => $movie]);
    }

    public function destroy(Movie $movie): JsonResponse
    {
        $this->movieService->deleteMovie($movie);
        return response()->json(['message' => 'Movie deleted successfully']);
    }

    public function publish(Movie $movie): JsonResponse
    {
        $movie = $this->movieService->publishMovie($movie);
        return response()->json(['message' => 'Movie published successfully', 'movie' => $movie]);
    }
}
