<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upozila extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='upozila';

    protected $fillable = [
        'district_id','code','upozila_name','created_by','updated_by','deleted_by'
    ];
}
