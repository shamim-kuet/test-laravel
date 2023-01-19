<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'partner_id','rider_id','merchant_id','purpose','message','image','status','created_by','updated_by','deleted_by'
    ];

    public function merchant()
    {
        return $this->hasOne(Merchant::class, 'id', 'merchant_id');
    }
    public function rider()
    {
        return $this->hasOne(Rider::class, 'id', 'rider_id');
    }
}
