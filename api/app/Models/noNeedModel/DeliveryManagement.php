<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryManagement extends Model
{
    use HasFactory, SoftDeletes;


    public function deliverStatus()
    {
        return $this->belongsTo(DeliveryStatus::class,'status','id');
    }

	  protected $fillable = [
        'order_id','merchant_id','partner_id','rider_id','hub_id','payment_status','collectable_amount','received_amount','note','plan','delivery_charge','cod_charge','weight_charge','total_return_cost','total_charge','package_details','assign_date','delivery_date','status','created_by','updated_by','deleted_by','invoice'
    ];

	public function order()
    {
        return $this->hasOne(Order::class, 'id','order_id');
    }

	public function merchant()
    {
        return $this->hasOne(Merchant::class, 'id','merchant_id');
    }

	public function rider()
    {
        return $this->hasOne(Rider::class, 'id','rider_id');
    }

    
    public function statuses()
    {
        return $this->hasOne(DeliveryStatus::class, 'id','status');
    }


    public function hub()
    {
        return $this->hasOne(Hub::class, 'hub_admin_id','hub_id');
    }

}
