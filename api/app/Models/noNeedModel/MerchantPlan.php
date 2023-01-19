<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
         'partner_id','merchant_id','delivery_plan_id','return_plan_id','created_by'
    ];


    public function plan()
    {
        return $this->hasOne(Plan::class, 'id','plan_id');
    }

    // public function deliveryplan()
    // {
    //     return $this->hasOne(Plan::class, 'id','delivery_plan_id');
    // }

    // public function returnplan()
    // {
    //     return $this->hasOne(Plan::class, 'id','return_plan_id');
    // }
}
