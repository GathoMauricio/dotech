<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleVerification extends Model
{
    protected $table = 'vehicle_verifications';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'vehicle_id',
        'author_id',
        'date',
        'kilometers',
        'type',
        'image',
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
    public function vehicle()
    {
        return $this->belongsTo
        (
            'App\Vehicle',
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
