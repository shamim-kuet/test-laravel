<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'created_by', 'updated_by', 'deleted_by'
    ];


    public function groupHasPermission()
    {
        return $this->hasMany(Permission::class, 'group_id', 'id');
    }
}