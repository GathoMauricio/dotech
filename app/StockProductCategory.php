<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockProductCategory extends Model
{
    protected $table = 'stock_product_categories';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ];
}
