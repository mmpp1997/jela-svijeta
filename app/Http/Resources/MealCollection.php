<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MealCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'meta' => [
                'currentPage'=> $this->currentPage(),
                'totalItems'=> $this->total(),
                'itemsPerPage'=> $this->perPage(),
                'totalPages'=> $this->lastPage(),
                
            ],
            'data' => $this->collection
            
        ];
    }
    public function paginationInformation($request, $paginated, $default)
    {
        unset($default['meta']);
        //unset($default['links']);
        return $default;
    }
}
