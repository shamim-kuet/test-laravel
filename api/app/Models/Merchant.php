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
    use HasFactory, SoftDeletes,Authenticatable, Authorizable;


    protected $guard = 'merchant';
	
	public function getKAM()
    {
        return $this->belongsTo(Admin::class, 'kam','id');
    }

    protected $searchable = [
            'columns' => [
            'id' => 10,
            'name' => 10,
            'ownername' => 10,
            'mobile' => 10,
            'email' => 10,
            'businessname' => 10,
        ]
    ];


    protected $fillable = [
       'name',
       'kam',
       'businessname',
       'username',
       'ownername',
       'photo',
       'logo',
       'address',
       'division_id',
       'district_id',
       'area_id',
       'zipcode',
       'telephone',
       'mobile',
       'email',
       'alternate_email',
       'password',
       'passwordHints',
       'website',
       'status',
       'member_type',
    ];
    protected $guarded=['id'];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }

    public function delete()
    {
        // delete all related product
        $this->products()->delete();
        // Product::where("seller_id", $this->id)->delete()

        // delete the seller
        return parent::delete();
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

