<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='district';

    protected $fillable = [
        'region_id','code','district_name','created_by','updated_by','deleted_by'
    ];
}
