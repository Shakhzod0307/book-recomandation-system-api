<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'author'=>$this->user->name,
            'genre'=>$this->genre->category,
            'title'=>$this->title,
            'image'=>$this->image,
            'page'=>$this->page_number,
            'description'=>$this->description,
            'created'=>$this->created_at,
        ];
    }
}
