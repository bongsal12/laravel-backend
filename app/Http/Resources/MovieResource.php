<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function PHPSTORM_META\map;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'overview' => $this->overview,
            'release_date' => $this->release_date,
            'rating' => $this->rating,
            'runtime' => $this->runtime,
            'is_movie' => $this->is_movie,
            'thumbnail_url' => $this->thumbnail_url,
            'bg_url' => $this->bg_url,
            'vdo_url' => $this->vdo_url,
            'is_trending' => $this->is_trending,
            'director' => $this->director,
            'writer' => $this->writer,
            'genres' => GenreResource::collection($this->whenLoaded('genre'))
        ];
    }
}
