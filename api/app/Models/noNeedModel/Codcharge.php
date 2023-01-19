<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Codcharge extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = ['percentage', 'partner_id'];
}
