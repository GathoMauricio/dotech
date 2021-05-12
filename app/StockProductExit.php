<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockProductExit extends Model
{
    protected $table = 'stock_product_exits';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'author_id',
        'stock_product_id',
        'quantity',
        'description',
        'status',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
	{
		parent::boot();
		static::creating(function ($query) {
            $query->author_id = \Auth::user()->id;
            $product = StockProduct::find($query->stock_product_id);
            if($product->return == 'SI')
                $query->status = 'USANDO';
            else
                $query->status = 'N/A';
		});
    }
    public function author()
    {
        return $this->belongsTo
        (
            'App\User',
            'author_id',
            'id'
        )
        ->withDefault();
    }
    public function product()
    {
        return $this->belongsTo
        (
            'App\StockProduct',
            'stock_product_id',
            'id'
        )
        ->withDefault();
    }
}
