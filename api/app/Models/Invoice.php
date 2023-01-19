    <?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $fillable = [];

	protected $guarded = [];

    public function getOrder()
    {
        return $this->belongsTo(Order::class, 'order_id','id');
    }
    public function getAdministration()
    {
        return $this->belongsTo(Admin::class, 'created_by','id');
    }
    public function getLog()
    {
        return $this->hasMany(InvoiceLog::class, 'invoice_id','id');
    }
}
