<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    protected $table = 'receptions';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'author_id',
        'company_id',
        'responsable',
        'phone',
        'email',
        'equipment',
        'description',
        'observation',
        'diagnostic',
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
    public function company()
    {
        return $this->belongsTo
        (
            'App\Company',
            'company_id',
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
