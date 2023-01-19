<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deviceinformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'device_token'
    ];
}
