<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignPickup extends Model
{
    use HasFactory, SoftDeletes;


	  protected $fillable = [
        'order_id','merchant_id','partner_id','rider_id','status','note','created_by','updated_by','deleted_by','qr_code'
    ];
    public function deliverStatus()
    {
        return $this->belongsTo(DeliveryStatus::class,'status','id');
    }

	public function order()
    {
        return $this->hasOne(Order::class, 'id','order_id');
    }

	public function merchant()
    {
        return $this->hasOne(Merchant::class, 'id','merchant_id');
    }

    public function hub()
    {
        return $this->hasOne(Hub::class, 'id','hub_id');
    }
	public function rider()
    {
        return $this->hasOne(Rider::class, 'id','rider_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id','created_by');
    }
}
