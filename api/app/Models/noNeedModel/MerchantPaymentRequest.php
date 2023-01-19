<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantPaymentRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'merchant_payment_requests';
    protected $primaryKey = 'id';

    protected $fillable = [
        'partner_id','merchant_id','payment_method','amount','payment_date','account_name','bank_name','account_number','routing_no','branch_no','remark','status','created_by','payment_status'
    ];
    public function merchant()
    {
        return $this->hasOne(Merchant::class, 'id','merchant_id');
    }


}
