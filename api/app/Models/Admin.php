<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Admin extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'administrations';

    protected $fillable = [
        'partner_id',
		'name',
        'email',
        'phone',
        'password',
        'user_type',
		'username',
        'emargency_contact',
        'designation',
		'dob',
        'religion',
		'present_address',
        'permanent_address',
        'marital_status',
        'gender',
        'religion',
        'joining_date',
        'employee_id',
        'facebook',
        'twitter',
        'linkedin',
        'github',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getUser($username)
    {
        return $this->where('email', $username)->first();
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id','user_type');
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
		//return $this->attributes['email'];
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
    /*public function setPasswordAttribute($password)
    {
        $this->attributes['password']=bcrypt($password);
    }*/
}
