<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'seller_stores';
    protected $fillable = [
        'partner_id','merchant_id','name','email','region','phone','address','zone','area','status','default_store'
    ];

	public function merchant()
    {
        return $this->hasOne(Merchant::class, 'id', 'merchant_id');
    }
}
