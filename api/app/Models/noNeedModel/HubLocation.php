<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HubLocation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'partner_id','name','region','zone','status','created_by','updated_by','deleted_by'
    ];
}
