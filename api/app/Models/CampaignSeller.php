<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignSeller extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'subcamp_id',
        'seller_id',
        'discount',
        'cashback',
        'status',
        'coverphoto'
    ];
}
