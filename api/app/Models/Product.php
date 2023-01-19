<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [];

    protected $guarded = [];


    public function getBrand()
    {
        return $this->belongsTo(Brand::class, 'brand', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'sub_category_id', 'id');
    }
    public function subsubcategory()
    {
        return $this->belongsTo(Subsubcategory::class, 'sub_sub_category_id', 'id');
    }
    public function lastcategory()
    {
        return $this->belongsTo(Lastcategory::class, 'lastcat_id', 'id');
    }

    public function productInventory()
    {
        return $this->hasOne(ProductInventory::class, 'product_id');
    }

    public function wishlists()
    {
        return $this->hasMany(CustomerWishlist::class, 'product_id');
    }
    public function orderdetails()
    {
        return $this->hasOne(OrderDetail::class, 'product_id');
    }
}
