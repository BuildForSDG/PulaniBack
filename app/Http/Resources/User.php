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
            'title' => $this->title,
            'lastName' => $this->lastName,
            'firstName' => $this->firstName,
            'otherName' => $this->otherName,
            'dateOfBirth' => $this->dateOfBirth,
            'gender' => $this->gender,
            'idType' => $this->idType,
            'idNumber' => $this->idNumber,
            'idDateOfIssue' => $this->idDateOfIssue,
            'idExpiryDate' => $this->idExpiryDate,
            'businesName' => $this->businesName,
            'businessAddress' => $this->businessAddress,
            'businesName' => $this->businesName,
            'phone' => $this->phone,
            'email' => $this->email,
            'yearsOfBusiness' => $this->yearsOfBusiness,
            'totalBusinessCapital' => $this->totalBusinessCapital,
            'areaOfResidence' => $this->areaOfResidence,
            'city' => 'Kampala',
            'numberOfDependants' => $this->numberOfDependants,
            'nextOfKin' => $this->nextOfKin,
        ];
    }
}


