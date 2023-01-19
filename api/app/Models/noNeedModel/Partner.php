<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory, SoftDeletes;

    //protected $guarded=['id'];
	
	 protected $fillable = [
        'legal_name','address','company_name','company_phone','company_email','contact_person_name','contact_person_phone','contact_person_email','hash_key','logo','subscription_type','subscription_expiry','password','status','username'
    ];
}
