<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    protected $table = 'companies';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'origin',
        'status',
        'name',
        'responsable',
        'rfc',
        'email',
        'phone',
        'address',
        'description',
        'image',
        'password',
        'iguala',
        'searches',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
	{
		parent::boot();
        static::creating(function ($query) {
            $query->image = 'compania.png';
		});
	}
}
