<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenances';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'author_id',
        'maintenance_type_id',
        'vehicle_id',
        'kilometers',
        'date',
        'amount',
        'description',
        'other',
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
    public function type()
    {
        return $this->belongsTo
        (
            'App\MaintenanceType',
            'maintenance_type_id',
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
