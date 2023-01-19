<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;/*  */
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleHasPermission extends Model
{
    use HasFactory, SoftDeletes;

    public $primaryKey = 'id';
    protected $fillable = [
        'group_id','permission_id','role_id','created_by','updated_by','deleted_by'
    ];

}
