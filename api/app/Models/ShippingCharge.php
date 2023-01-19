<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingCharge extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = [
		'name',
		'location',
		'charge',
	];
	
	protected $guarded = [];
}
