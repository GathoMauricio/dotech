<?php
namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'author_id',
        'name',
        'description',
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
