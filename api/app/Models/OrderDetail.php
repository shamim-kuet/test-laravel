<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $fillable = [];

	protected $guarded = [];

	public function getProduct(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }
	public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
