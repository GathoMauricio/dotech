<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles;
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
        'evaluation',
        'fecha_contrato',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        //'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->image = 'perfil.png';
        });
    }

    public function status()
    {
        return $this->belongsTo(
            'App\StatusUser',
            'status_user_id',
            'id'
        )
            ->withDefault();
    }

    public function rol()
    {
        return $this->belongsTo(
            'App\RolUser',
            'rol_user_id',
            'id'
        )
            ->withDefault();
    }

    public function location()
    {
        return $this->belongsTo(
            'App\LocationUser',
            'location_user_id',
            'id'
        )
            ->withDefault();
    }

    public function vacaciones()
    {
        return $this->hasMany('App\Vacacion', 'user_id');
    }
}
