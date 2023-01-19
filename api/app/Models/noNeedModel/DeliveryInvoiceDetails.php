<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryInvoiceDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'delivery_invoice_details';

	protected $fillable = [
        'merchant_id','invoice_id','order_id','partner_id','status','created_by','updated_by','deleted_by'
    ];

	public function order()
    {
        return $this->hasOne(Order::class, 'id','order_id');
    }

    public function invoice()
    {
        return $this->hasOne(Order::class, 'id','invoice_id');
    }


    public function statuses()
    {
        return $this->hasOne(DeliveryStatus::class, 'id','status');
    }
    public function merchant()
    {
        return $this->hasOne(Merchant::class, 'id','merchant_id');
    }

}
