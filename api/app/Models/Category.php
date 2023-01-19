<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'seotitle', 'details', 'keywords', 'thumb', 'banner','medium','sequence', 'status', 'mainmenu'
    ];

    protected $guarded=['id'];

    /**
     * Get sub categories with sub category
     * @return HasMany
     */
    public function activeSubCategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'id')->where('status', 1)->where('subcategories.deleted_at', null)->has('activeSubSubCategories');
    }

    /**
     * Get products with category
     * @return HasMany
     */
	public function products()
    {
        return $this->hasMany(Product::class, 'cat_id','id');
    }
}
