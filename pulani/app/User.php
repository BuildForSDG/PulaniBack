<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable;

    public $table = "users";

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'title'.
        'other',
        'gender',
        'surname',
        'firstname',
        'othernames',
        'dob',
        'telephone',
        'number_of_dependents',
        'passport',
        'voters_id',
        'drivers_licence',
        'id_number',
        'photo',
        'email_verified_at',
    ];

    public function loans()
    {
        return $this->hasMany(LoanRequest::class, 'user_id', 'id');
    }
}
