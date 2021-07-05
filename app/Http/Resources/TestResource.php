<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return [
//            'id' => $this->id,
//            'name' => $this->name,
//            'age' => $this->age,
//            'last_name' => $this->last_name,
//            'deleted_at' => $this->deleted_at,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//        ];
        return parent::toArray($request);
    }
}
