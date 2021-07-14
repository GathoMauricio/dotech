<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class SalePayment extends Model
{
    protected $table = 'sale_payments';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'sale_id',
        'description',
        'amount',
        'document',
        'created_at',
        'updated_at'
    ];
    public function sale()
    {
        return $this->belongsTo
        (
            'App\Sale',
            'sale_id',
            'id'
        )
        ->withDefault();
    }
}
