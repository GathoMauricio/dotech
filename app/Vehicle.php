<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'vehicle_type_id',
        'brand',
        'model',
        'fuel',
        'kilometers',
        'enrollment',
        'year',
        'displacement',
        'power',
        'color',
        'visibility',
        'created_at',
        'updated_at',
    ];

    public function type()
    {
        return $this->belongsTo(
            'App\VehicleType',
            'vehicle_type_id',
            'id'
        )
            ->withDefault();
    }

    public function mantenimientos()
    {
        return $this->hasMany('App\Maintenance', 'vehicle_id')->orderBy('id', 'DESC');
    }
}
