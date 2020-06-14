<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'capital',
        'income',
        'transport',
        'savings',
        'otherExpenses',
        'date',
        'user',
    ];

    public function user()
    {
        return $this->hasMany(App\User::class, 'user_id', 'id');
    }
}
