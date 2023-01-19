<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartnerManage extends Model
{
    use HasFactory;
    use SoftDeletes;
	
	protected $guarded = [];

    public function rewardsCategory()
    {
        return $this->belongsTo(RewardsCategory::class, 'rewards_category_id');
    }
}
