<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    //protected $guarded=['id'];

	protected $fillable = [
        'partner_id','merchant_id','store_id','delivery_plan_id','return_plan_id','partialdelivery','merchant_order_id','consignment_id','payment_status','package_description','instruction','delivery_note','collectable_amount','customer_name','customer_mobile','customer_email','customer_address','customer_zone','customer_latitude','customer_longtitude','total_cost','total_return_cost','delivery_charge','weight_charge','cod_charge','district','upozila','delivery_date','status','created_by','updated_by','deleted_by','time','weight'
    ];


    public function deliverStatus()
    {
        return $this->belongsTo(DeliveryStatus::class,'status','id');
    }
	public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class, 'order_id','id');
    }

    public function merchant()
    {
        return $this->hasOne(Merchant::class, 'id','merchant_id');
    }

    public function plan()
    {
        return $this->hasOne(Plan::class, 'id','delivery_plan_id');
    }

    public function returnplan()
    {
        return $this->hasOne(Plan::class, 'id','return_plan_id');
    }

	public function store()
    {
        return $this->hasOne(Store::class, 'id','store_id');
    }

    public function orderlog()
    {
        return $this->hasMany(OrderLog::class, 'order_id','id');
    }

    public function deliveryManagement()
    {
        return $this->hasOne(DeliveryManagement::class, 'order_id','id');
    }
    public function district()
    {
        return $this->hasOne(District::class, 'district_id','district');
    }
    public function upozila()
    {
        return $this->hasOne(Upozila::class, 'upozila_id','upozila');
    }
}
