<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialOffer extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = [
		'seller_id',
		'url',
		'slug',
		'name',
		'image',
		'meta_details',
		'keywords',
		'sequence',
		'status'
	];
	
	protected $guarded = [];
}
