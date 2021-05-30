<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockProductImage extends Model
{
    protected $table = 'stock_product_images';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'author_id',
        'stock_product_id',
        'image',
        'description',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
	{
		parent::boot();
		static::creating(function ($query) {
            $query->author_id = \Auth::user()->id;
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
