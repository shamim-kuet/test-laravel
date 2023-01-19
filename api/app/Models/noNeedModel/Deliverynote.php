<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deliverynote extends Model
{
    use HasFactory, SoftDeletes;

	protected $table = 'deliverynote';
	protected $fillable = ['type','name', 'partner_id'];
}
