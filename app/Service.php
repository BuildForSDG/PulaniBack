<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'earnings',
        'savings',
        'costsIncurred',
        'date',
        'personalExpenses',
        'email_verified_at',
        'user',
    ];

    public function user()
    {
        return $this->hasMany(App\User::class, 'user_id', 'id');
    }
}
