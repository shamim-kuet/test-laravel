<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryReschedule extends Model
{
    use HasFactory, SoftDeletes;


	  protected $fillable = [
        'consignment_id','partner_id','rider_id','reassigned_rider_id','reassign_date','15','status','created_by','updated_by','deleted_by'
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

    public function reassignrider()
    {
        return $this->hasOne(Rider::class, 'id','reassigned_rider_id');
    }
	
}
