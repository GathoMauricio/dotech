<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class ProductSale extends Model
{
    protected $table = 'product_sale';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'sale_id',
        'measure',
        'description',
        'unity_price_buy',
        'unity_price_sell',
        'quantity',
        'discount',
        'total_buy',
        'total_sell',
        'utility',
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
