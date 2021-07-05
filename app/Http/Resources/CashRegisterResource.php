<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashRegisterResource extends JsonResource
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
//            'box_id' => $this->box_id,
//            'last_amount' => $this->last_amount,
//            'now_amount' => $this->now_amount,
//            'deleted_at' => $this->deleted_at,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//        ];
        return parent::toArray($request);
    }
}
