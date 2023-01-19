<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lastcategory extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = [
		'cat_id', 'subcat_id', 'subsubcat_id', 'name', 'slug', 'details', 'seotitle', 'keywords', 'thumb', 'banner', 'sequence', 'status'
	];
	
	protected $guarded = [];
}
