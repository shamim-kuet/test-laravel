<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartnerRewardsValue extends Model
{
    use HasFactory;

    use SoftDeletes;
	
	protected $guarded = [];

    protected $fillable = [
        'rewards_category_id',
        'partner_id',
        'reward_points',
        'price_value',
        'status'
    ];
}
