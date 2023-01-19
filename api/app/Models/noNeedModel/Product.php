<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    //protected $guarded=['id'];

	  protected $fillable = [
        'partner_id','merchant_id','store_id','name','sku','subtitle','description','price','sell_price','weight','height','depth','status','created_by','updated_by','deleted_by'
    ];

	public function merchant()
    {
        return $this->hasOne(Merchant::class, 'id','merchant_id');
    }

	public function store()
    {
        return $this->hasOne(Store::class, 'id','store_id');
    }

    public function pickupDetails()
    {
        return $this->hasOne(AssignPickupDetails::class, 'product_id','id');
    }
}
