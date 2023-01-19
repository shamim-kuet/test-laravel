<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RewardsCategory extends Model {

    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function getPartners() {
        return $this->hasMany( PartnerManage::class, 'rewards_category_id', 'id' );
    }

}
