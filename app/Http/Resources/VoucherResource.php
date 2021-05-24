<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends JsonResource
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
            'amount_assigned_id' => $this->amount_assigned_id,
            'expense_type_id' => $this->expense_type_id,
            'check_type_id' => $this->check_type_id,
            'concept' => $this->concept,
            'amount' => $this->amount,
            'photo' => $this->photo,
            'Store' => $this->Store,
            'RFC' => $this->RFC,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
