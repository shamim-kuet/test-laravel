<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $fillable = [];

	protected $guarded = [];

	public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function orderpayments()
    {
        return $this->hasOne(OrderPayment::class, 'order_id');
    }

	public function getMerchant()
    {
        return $this->belongsTo(Merchant::class, 'seller_id','id');
    }
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id','id');
    }
    public function getPaymentDetails()
    {
        return $this->hasOne(OrderPayment::class, 'order_id');
    }
	public function getCustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id','id');
    }
    public function orderLog()
    {
        return $this->hasMany(OrderLog::class, 'order_id');
    }
    public function shipping_address()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id','id');
    }
}
