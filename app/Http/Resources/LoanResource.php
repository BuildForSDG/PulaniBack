<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    public function toArray($request)
    {        
        return[
            'user_id' => $this->user_id,
            'loanrequestamount' => $this->loanrequestamount,
            'proposedcollaterals' => $this->proposedcollaterals,
            'purposeofloan' => $this->purposeofloan,
            'loanwithanotherbank' => $this->loanwithanotherbank,
            'detailsofotherloan' => $this->detailsofotherloan,
            'location_of_business' => $this->location_of_business,
            'loanperiod' => $this->loanperiod,
            'interestrate' => $this->interestrate,
            'loanissuer' => $this->loanissuer,
            'date_form_submitted' => $this->date_form_submitted,
        ];
    }
}
