<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'label' => str_replace("'", "`", $this->category_name),
            'banner_path' => $this->banner_path,
            'logo_path' => $this->logo_path,
            'data' => $this->getChildren->count() > 0 ? $this->getSubCategories($this->getChildren) : [],
            'status' => $this->status,
        ];
    }
    public function getSubCategories($childrenArr)
    {
        return $childrenArr->map(function ($children) {
            return [
                'id' => $children->id,
                'parent_id' => $children->parent_id,
                'label' => str_replace("'", "`", $children->category_name),
                'banner_path' => $children->banner_path,
                'logo_path' => $children->logo_path,
                'data' => $children->getChildren->count() > 0 ? $this->getSubCategories($children->getChildren) : [],
                'status' => $children->status
            ];
        });
    }
    public function prepareData($request)
    {
        return [];
    }
}
