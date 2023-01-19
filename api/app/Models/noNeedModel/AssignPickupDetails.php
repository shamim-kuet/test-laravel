<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignPickupDetails extends Model
{
    use HasFactory, SoftDeletes;


	  protected $fillable = [
        'assign_pickup_id','product_id','order_id','note','quantity','status','created_by','updated_by','deleted_by'
    ];

	public function order()
    {
        return $this->hasOne(Order::class, 'id','order_id');
    }

	public function assignPickup()
    {
        return $this->hasOne(AssignPickup::class, 'id','assign_pickup_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id','product_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id','created_by');
    }
}
