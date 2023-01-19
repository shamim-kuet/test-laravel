<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employeeid extends Model
{
    use HasFactory, SoftDeletes;

	protected $table = 'employeeid';
	protected $fillable = ['role_id','name', 'partner_id'];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
