<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return[
            'id' => $this->id,
            'lname' => $this->lname,
            'fname' => $this->fname,
            'email' => $this->email,
            'locality' => $this->locality,
            'company' => $this->company,
            'address' => $this->address,
            'city' => $this->city,
            'about' => $this->about,
            'phone' => $this->phone,
            'country' => $this->country,
        ];
    }
}


