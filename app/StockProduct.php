<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockProduct extends Model
{
    protected $table = 'stock_products';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'category_id',
        'product',
        'description',
        'quantity',
        'return',
        'image',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
	{
		parent::boot();
        static::creating(function ($query) {
            $query->image = 'product_stock.png';
		});
	}
    public function category()
    {
        return $this->belongsTo
        (
            'App\StockProductCategory',
            'category_id',
            'id'
        )
        ->withDefault();
    }
}
