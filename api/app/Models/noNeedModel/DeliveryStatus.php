<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','merchant_status','color', 'font_color','partner_id', 'display_control','type'];

    public function totalOrder()
    {
        return $this->hasMany(DeliveryManagement::class, 'status', 'id');
    }
}
