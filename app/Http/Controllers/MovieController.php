<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Movie::with('genre');

    if ($request->has('is_trending')) {
        $query->where('is_trending', $request->is_trending);
    }
      if ($request->has('genre')) {
        $query->whereHas('genre', function($q) use ($request) {
            // $q->where('name', $request->genre);
            $q->where('id', $request->genre);
        });
    }
  if ($request->has('search')) {

        $query->where('title', 'like', '%' . strtolower($request->search) . '%');
    };

    $query->orderBy('rating', 'desc');

    $movies = $query->get();
        if($movies->count()>0){
            return response()->json([
                'message' => 'success',
                'data' => MovieResource::collection($movies)
            ]);
        }
        else{
            return response()->json(['message'=> 'No data'],200);
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'overview' => 'required|string',
            'release_date' => 'required|string',
            'rating' => 'required|numeric',
            'runtime' => 'required|string',
            'is_movie' => 'required|boolean',
            'thumbnail_url' => 'required|string',
            'bg_url' => 'required|string',
            'vdo_url' => 'required|string',
            'is_trending' => 'required|boolean',
            'director' => 'nullable|string|max:255',
            'writer' => 'nullable|string|max:255',
            'genres' => 'array|required',
            'genres.*' => 'string',
        ]);

        $movie = Movie::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'overview' => $validated['overview'],
            'release_date' => $validated['release_date'],
            'rating' => $validated['rating'],
            'runtime' => $validated['runtime'],
            'is_movie' => $validated['is_movie'],
            'thumbnail_url' => $validated['thumbnail_url'],
            'bg_url' => $validated['bg_url'],
            'vdo_url' => $validated['vdo_url'],
            'is_trending' => $validated['is_trending'],
            'director' => $validated['director'] ?? null,
            'writer' => $validated['writer'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $genres = Genre::whereIn('name', $validated['genres'])->pluck('id');
        $movie->genre()->attach($genres);
        $movie->load('genre');

        return response()->json([
            "message" => "Create sucessfully",
            "data" => new MovieResource($movie)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::with('genre')->find($id);
        if($movie->count()>0){
            return response()->json([
                "message" => "Find movie sucessfully",
                "data" =>new MovieResource($movie)
            ]);
        }else{
            return response()->json(["message" => "Id not found!"]);
        }


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255',
            'overview' => 'sometimes|string',
            'release_date' => 'sometimes|string',
            'rating' => 'sometimes|numeric',
            'runtime' => 'sometimes|string',
            'is_movie' => 'sometimes|boolean',
            'thumbnail_url' => 'sometimes|string',
            'bg_url' => 'sometimes|string',
            'vdo_url' => 'sometimes|string',
            'is_trending' => 'sometimes|boolean',
            'director' => 'nullable|string|max:255',
            'writer' => 'nullable|string|max:255',
            'genres' => 'sometimes|array',
            'genres.*' => 'string',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->update($validated);

        if (isset($validated['genres'])) {
            $genres = Genre::whereIn('name', $validated['genres'])->pluck('id');
            $movie->genre()->sync($genres);
        }
        return response()->json([
            "message" => "Update Success",
            "data" =>new MovieResource($movie->load('genre'))
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        if ($movie->count()>0) {
            $movie->genre()->detach();
            $movie->delete();
            return response()->json(['message' => 'Movie deleted successfully.']);
        } else {
            return response()->json(['message' => 'Movie not found'], 404);
        }
    }

}
