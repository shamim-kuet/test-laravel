<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantContact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'partner_id','merchant_id','name','email','phone','emargency_contact','photo','address','status'
    ];
}
