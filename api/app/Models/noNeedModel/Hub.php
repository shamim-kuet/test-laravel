<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hub extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'partner_id','hub_location_id','hub_admin_id','name','code','email','username','phone','address','emargency_contact','logo','contact_person_name','contact_person_phone','contact_person_email','password','status','plan','canlogin','created_by','updated_by','deleted_by'
    ];
}
