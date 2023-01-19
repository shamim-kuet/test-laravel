<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceLog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [];

    protected $guarded = [];

    public function getInvoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id','id');
    }
    public function getAdministration()
    {
        return $this->belongsTo(Admin::class, 'created_by','id');
    }
}
