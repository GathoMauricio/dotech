<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'companies';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'author_id',
        'vendedor_id',
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
        'updated_at',
        'porcentaje',
        'fecha_prospecto',
        'fecha_cliente',
        'email_coreccto',
        'mira',
        'web',
        'giro'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->image = 'compania.png';
        });
    }

    public function seguimientos()
    {
        return $this->hasMany(CompanyFollow::class);
    }
    public function repositorios()
    {
        return $this->hasMany(CompanyRepository::class);
    }
    public function documentaciones()
    {
        return $this->hasMany(CompanyDocument::class);
    }
    public function departamentos()
    {
        return $this->hasMany(CompanyDepartment::class);
    }
    public function cotizaciones_proyectos()
    {
        return $this->hasMany(Sale::class);
    }
    public function author()
    {
        return $this->belongsTo(
            'App\User',
            'author_id',
            'id'
        )
            ->withDefault();
    }
    public function vendedor()
    {
        return $this->belongsTo(
            'App\User',
            'vendedor_id',
            'id'
        )
            ->withDefault();
    }
}
