<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\GenreResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MoiveResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'description'  => $this->description,
            'poster'       => $this->poster_path,
            'banner'       => $this->banner_path,
            'release_data' => $this->release_data,
            'vote'         => $this->vote,
            'vote_count'   => $this->vote_count,
            'genres'       => GenreResource::collection($this->genres),
        ];
    }
}
