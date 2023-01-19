<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;


    public $primaryKey = 'id';
    protected $fillable = [
        'name', 'guard_name', 'created_by', 'updated_by', 'deleted_by', 'group_id'
    ];


    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
