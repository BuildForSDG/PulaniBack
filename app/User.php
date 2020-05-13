<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//JWT
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements JWTSubject;
{
    use LaratrustUserTrait;
    use Notifiable;

    protected $hidden = [
        'password', 'remember_token',
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

    //JWT functions
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
