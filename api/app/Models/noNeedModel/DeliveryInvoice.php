<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
      'merchant_id','invoice_no','partner_id','invoice_date','delivery_charge','return_charge','total_charge','weight_charge','totalorder','cod_charge','collection','status','created_by','updated_by','deleted_by'
    ];

    public function merchant()
    {
        return $this->hasOne(Merchant::class, 'id', 'merchant_id');
    }


    public function invoiceDetails()
    {
        return $this->hasMany(DeliveryInvoiceDetails::class, 'invoice_id', 'id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id', 'created_by');
    }
}
