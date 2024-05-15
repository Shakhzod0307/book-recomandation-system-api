<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MostRatedReadersResource extends JsonResource
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
            'user'=>$this->user->name,
            'rating'=>$this->rating,
            'type'=>$this->type,
            'comment'=>$this->comment,
            'created_at'=>$this->created_at,
        ];
    }
}
