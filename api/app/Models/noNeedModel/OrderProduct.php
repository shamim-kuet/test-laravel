<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'partner_id','order_id','product_id','quantity','status','created_by','updated_by','deleted_by'
    ];

	public function product()
    {
        return $this->hasOne(Product::class, 'id','product_id');
    }
}
