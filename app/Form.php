<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'forms';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'author_id',
        'name',
        'description',
        'document',
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
}
