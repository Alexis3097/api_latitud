<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'=> $this->id,
            'user_type_id'=> $this->user_type_id,
            'name'=> $this->name,
            'last_name1'=> $this->last_name1,
            'last_name2'=> $this->last_name2,
            'job'=> $this->job,
            'date_of_birth'=> $this->date_of_birth,
            'email'=> $this->email,
            'photo'=> $this->photo,
            'email_verified_at'=> $this->email_verified_at,
            'password'=> $this->password,
            'remember_token'=> $this->remember_token,
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at,
            'deleted_at'=> $this->deleted_at,
        ];

    }
}
