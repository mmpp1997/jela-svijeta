<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //define fields that will be returned when accessing tags
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug
        ];
    }
}
