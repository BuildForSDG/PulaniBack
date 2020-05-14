<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use SoftDeletes;

    protected $table = 'loans';

    public $primary_key = 'id';
  
    public $timestamp = 'true';

    protected $fillable = [
        'user_id',
        'loanrequestamount',
        'proposedcollaterals',
        'purposeofloan',
        'loanwithanotherbank',
        'detailsofotherloan',
        'location_of_business',
        'loanperiod',
        'interestrate',
        'loanissuer',
        'date_form_submitted',
    ];

    public function user()
    {
        return $this -> belongsTo('App\User');
        //return $this->belongsTo(User::class, 'user_id');
    }
}
