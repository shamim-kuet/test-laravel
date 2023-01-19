<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerContent extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = [
		'seller_id', 'menu_id', 'title', 'content', 'status'
	];
	
	protected $guarded = [];
}
