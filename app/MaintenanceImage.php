<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceImage extends Model
{
    protected $table = 'maintenance_images';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'maintenance_id',
        'image',
        'description',
        'created_at',
        'updated_at'
    ];
}
