<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
        'email', 
        'password',
        'token',
        'created_at',
        'updated_at'
    ];

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
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
