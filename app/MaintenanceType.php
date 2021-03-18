<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceType extends Model
{
    protected $table = 'maintenance_types';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'type',
        'created_at',
        'updated_at',
    ];
}
