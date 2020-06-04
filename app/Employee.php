<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'name_khmer', 
        'gender', 
        'email',
        'password',
        'dob',
        'start_date',
        'end_date',
        'annual_leave',
        'id_card',
        'bank_account',
        'salary',
        'phone',
        'address',
        'contact',
        'contact_name',
        'contact_relation',
        'contact_phone',
        'contract',
        'profile',
        'hobby',
        'home_town',
        'self_intro',
        'goal',
        'education',
        'status',
        'supervisor_id',
        'department_id',
        'unit_id',
        'position_id',
        'group_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
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
