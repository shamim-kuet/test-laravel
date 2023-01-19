<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $fillable = [];
	protected $guarded = [];

    /**
     * Get sub-sub categories with sub category
     * @return HasMany
     */
    public function activeSubSubCategories()
    {
        return $this->hasMany(SubSubcategory::class, 'sub_category_id', 'id')->where('sub_sub_categories.deleted_at', null)
            ->has('activeProducts')->where('status', 1);
    }

    /**
     * Get category with sub category
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get products with sub category
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id','id');
    }
}
