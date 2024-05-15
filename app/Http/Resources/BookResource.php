<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'author'=>new UserResource($this->user),
            'genre'=>new GenreResource($this->genre),
            'title'=>$this->title,
            'image'=>$this->image,
            'page'=>$this->page_number,
            'description'=>$this->description,
            'created'=>$this->created_at,
            'ratings'=>RatingResource::collection($this->ratings)
        ];
    }
}
