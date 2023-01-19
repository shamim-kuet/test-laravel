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

class Merchant extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use authenticatable;
    use HasFactory;
    use SoftDeletes;
    use Authenticatable;
    use Authorizable;

    protected $fillable = [
        'partner_id','name','code','hub_id','email','phone','nid','emargency_contact','logo','member_type','plan','password','status','canlogin','username','enroll_date','logo_source','district_id','upozila_id'
    ];

    public function business()
    {
        return $this->hasOne(MerchantBusiness::class, 'merchant_id', 'id');
    }

    public function contacts()
    {
        return $this->hasOne(MerchantContact::class, 'merchant_id', 'id');
    }

    public function documents()
    {
        return $this->hasOne(MerchantDocument::class, 'merchant_id', 'id');
    }

    public function getUser($username)
    {
        return $this->where('email', $username)->first();
    }

     public function hub()
     {
         return $this->hasOne(Hub::class, 'id', 'hub_id');
     }

    public function allplan()
    {
        return $this->hasMany(MerchantPlan::class, 'merchant_id', 'id');
    }

    public function deliveryplan()
    {
        return $this->allplan()->with('plan')->where('plan_type', 'delivery');
    }

    public function returnplan()
    {
        return $this->allplan()->with('plan')->where('plan_type', 'return');
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
