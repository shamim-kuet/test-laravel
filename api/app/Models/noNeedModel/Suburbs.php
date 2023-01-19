<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suburbs extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'suburbss';

	protected $fillable = ['suburbs', 'partner_id','created_by'];
}
