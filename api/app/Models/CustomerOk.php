<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Customer extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $searchable = [
        'columns' => [
            'id' => 10,
            'fullname' => 10,
            'username ' => 10,
            'mobile' => 10,
            'email' => 10,
        ]
    ];


    protected $fillable = [
        'fullname',
        'username',
        'photo',
        'contact',
        'address',
        'email',
        'division',
        'district',
        'area',
        'zipcode',
        'status',
        //        'language',
        //        'telephone',
        //        'mobile',
        //        'alternate_email',
        'password',
        'passwordHints',
        //        'device',
        //        'device_token',
        //        'website',
        //        'otpverify',
        //        'agreement_complete',
        //        'business_complete',
        //        'payment_complete',
        //        'status',
        //        'member_type',
        //        'default_tax_code',
        //        'reference_id',
        //        'default_tax_code',
        //        'agreement',
        //        'created_by',
        //        'updated_by',
        //        'deleted_by',
        //        'created_at',
        //        'updated_at',
        //        'deleted_at',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
