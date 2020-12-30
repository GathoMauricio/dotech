<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Auth;
class SaleFollow extends Model
{
    protected $table = 'sale_follows';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'sale_id',
        'author_id',
        'body',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
	{
		parent::boot();

		static::creating(function ($query) {
			$query->author_id = Auth::user()->id;
		});
	}
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
}
