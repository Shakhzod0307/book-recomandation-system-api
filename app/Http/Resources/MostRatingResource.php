<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MostRatingResource extends JsonResource
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
            'user'=>new UserResource($this->user),
            'book'=>new RatingBookResource($this->book),
            'rating'=>$this->rating,
            'take_time'=>$this->take_time,
            'type'=>$this->type,
            'comment'=>$this->comment,
            'created_at'=>$this->created_at,
        ];
    }
}
