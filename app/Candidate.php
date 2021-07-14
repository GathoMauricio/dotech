<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'status_user_id',
        'rol_user_id',
        'location_user_id',
        'name',
        'middle_name',
        'last_name',
        'phone',
        'emergency_phone',
        'address',
        'image',
        'email',
        'password',
        'api_token',
        'fcm_token',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->image = 'perfil.png';
            $query->status_user_id = 1;
            $query->rol_user_id = 4;
        });
    }
    public function status()
    {
        return $this->belongsTo
        (
            'App\StatusUser',
            'status_user_id',
            'id'
        )
            ->withDefault();
    }
    public function rol()
    {
        return $this->belongsTo
        (
            'App\RolUser',
            'rol_user_id',
            'id'
        )
            ->withDefault();
    }
    public function location()
    {
        return $this->belongsTo
        (
            'App\LocationUser',
            'location_user_id',
            'id'
        )
            ->withDefault();
    }
}
