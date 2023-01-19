<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $fillable = [];

	protected $guarded = [];

    public function division()
    {
        return $this->hasOne(Division::class,'id', 'division');
    }
    public function area()
    {
        return $this->hasOne(Area::class,'id', 'area');
    }
    public function district()
    {
        return $this->hasOne(District::class,'id', 'district');
    }
}
