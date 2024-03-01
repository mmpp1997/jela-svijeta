<?php

namespace App\Http\Resources;

use App\Services\TimeCompare;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //define status based on user input (diff_time)
        $status="created";
        if ($request->has('diff_time')) {

            $status = TimeCompare::getStatus(
                $this->updated_at,
                $this->deleted_at,
                $request->input('diff_time')
            );
        }
        //define fields that will be returned when accessing meal
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $status,
            //return meal category if user defines it in a query
            'category' => $this->whenLoaded('category', function () {
                return new CategoryResource(Category::find($this->category));
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            //return meal ingredients if user defines it in a query
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients')),
            //return meal tags if user defines it in a query
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
