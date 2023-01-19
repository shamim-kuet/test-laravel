<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'partner_id','merchant_id','documents_type','documents_type_id','headline','files','status','doc_source'
    ];
}
