<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id','status','updated_date','created_by','deleted_by','deleted_at','created_at','updated_at'
    ];

}
