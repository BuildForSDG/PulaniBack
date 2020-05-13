<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use SoftDeletes;

    public $table = 'loans';

    protected $fillable = [
        'user_id',
        'name_of_business',
        'address_of_business',
        'location_of_business',
        'telephone_number',
        'number_of_years_in_business',
        'total_business_capital',
        'loan_request_amount',
        'proposed_collaterals',
        'direction_of_route_to_business',
        'direction_of_route_to_residence',
        'date_form_submitted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
