<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
{
    return [
        'id' => $this->id,
        'title' => $this->title,
        'price_euros' => $this->price, 
        'image_url' => $this->image ? asset('storage/' . $this->image) : null,
        'author' => $this->whenLoaded('author', function () {
            return [
                'id' => $this->author->id,
                'name' => $this->author->name,
                'firstname' => $this->author->firstname,
            ];
        }),
    ];
}
}
