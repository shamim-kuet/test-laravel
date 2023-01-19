<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $fillable = [];

	protected $guarded = [];

    /**
     * Get sub-sub categories with sub category
     * @return HasMany
     */
    public function activeButtons()
    {
        return $this->hasMany(BannerButtons::class, 'banner_id');
    }
}
