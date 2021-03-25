<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Expense extends Model
{
    protected $table = 'expenses';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'author_id',
        'status',
        'title',
        'detail',
        'amount',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
	{
		parent::boot();

		static::creating(function ($query) {
			$query->author_id = Auth::user()->id;
            $query->status = 'Pendiente';
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
}
