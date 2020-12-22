<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class SaleDocument extends Model
{
    protected $table = 'sale_documents';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'sale_id',
        'description',
        'document',
        'inner_identifier',
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
