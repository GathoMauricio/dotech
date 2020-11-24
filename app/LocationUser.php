<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationUser extends Model
{
    protected $table = 'locations_users';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
}
