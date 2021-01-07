<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceLocation extends Model
{
    protected $table = 'service_locations';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
}
