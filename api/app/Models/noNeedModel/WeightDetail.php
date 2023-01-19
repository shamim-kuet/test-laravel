<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeightDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'partner_id','plan_type','increment_value','unit','after_weight','status','created_by','updated_by','deleted_by'
    ];
}
