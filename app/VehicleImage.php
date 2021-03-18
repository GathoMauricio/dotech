<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    protected $table = 'vehicle_images';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'vehicle_id',
        'image',
        'description',
        'created_at',
        'updated_at'
    ];
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
