<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class VehicleHistory extends Model
{
    protected $table = 'vehicle_histories';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'author_id',
        'vehicle_id',
        'kilometers',
        'description',
        'observation',
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
}
