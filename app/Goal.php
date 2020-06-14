<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'period',
        'date',
    ];

    public function user()
    {
        return $this->hasMany(App\User::class, 'user_id', 'id');
    }
}
