<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'seotitle', 'details', 'keywords', 'thumb', 'banner','medium','sequence', 'status', 'mainmenu'
    ];

    protected $guarded=['id'];

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class, 'category_id','id');
    }

	public function products()
    {
        return $this->hasMany(Product::class, 'cat_id','id');
    }


}
