<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
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
}
