<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubSubcategory extends Model
{
    use HasFactory;
	use SoftDeletes;

    protected $table = 'sub_sub_categories';

	protected $fillable = [
		'category_id', 'sub_category_id', 'name', 'slug', 'details', 'seotitle', 'keywords', 'thumb', 'banner', 'sequence', 'status'
	];

	protected $guarded = [];

    /**
     * Get products with sub-sub category
     * @return BelongsTo
     */
    public function subCategory()
    {
        return $this->belongsTo(Subcategory::class, 'sub_category_id','id');
    }

    /**
     * Get products with sub-sub category
     * @return HasMany
     */
    public function activeProducts()
    {
        return $this->hasMany(Product::class, 'sub_sub_category_id','id')->where('status', 1);
    }

}
