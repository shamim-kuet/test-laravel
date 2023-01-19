<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryDetails extends Model
{
    use HasFactory, SoftDeletes;


	  protected $fillable = [
        'delivery_management_id','product_id','order_id','quantity','status','created_by','updated_by','deleted_by'
    ];

	public function order()
    {
        return $this->hasOne(Order::class, 'id','order_id');
    }

	public function delivery()
    {
        return $this->hasOne(DeliveryManagement::class, 'id','delivery_management_id');
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
