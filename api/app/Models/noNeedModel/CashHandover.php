<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashHandover extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'delivery_cash_handover';

	  protected $fillable = [
        'consignment_id','partner_id','order_id','rider_id','delivery_date','payable_amount','collected_amount','note','status','created_by','updated_by','deleted_by'
    ];

	public function order()
    {
        return $this->hasOne(Order::class, 'id','order_id');
    }

	public function rider()
    {
        return $this->hasOne(Rider::class, 'id','rider_id');
    }

}
