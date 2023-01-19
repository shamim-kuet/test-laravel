<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

class Rider extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use authenticatable;
    use HasFactory, SoftDeletes,Authenticatable, Authorizable;

    public $table = 'riders';
    public $primaryKey = 'id';

    protected $fillable = [
        'partner_id','hub_id','name','employee_id','email','phone','username','emargency_contact','address','photo','joining_date','enroll_date','password','status','zone','area','role','canlogin','status','created_by','updated_by','deleted_by'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUser($username)
    {
        return $this->where('email', $username)->first();
    }

	 public function hub()
    {
        return $this->hasOne(Hub::class, 'id', 'hub_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
		//return $this->attributes['name'];
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
