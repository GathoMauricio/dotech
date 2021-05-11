<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleHistoryImage extends Model
{
    protected $table = 'vehicle_history_images';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'author_id',
        'vehicle_history_id',
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
    public function history()
    {
        return $this->belongsTo
        (
            'App\vehicle_history_id',
            'vehicle_id',
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
