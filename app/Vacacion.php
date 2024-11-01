<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    use HasFactory;

    protected $table = 'vacaciones';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'estatus',
        'tipo',
        'dias',
        'fecha_inicio',
        'motivo',
        'motivo_denegado'
    ];

    public function empleado()
    {
        return $this->belongsTo(
            'App\User',
            'user_id',
            'id'
        )
            ->withDefault();
    }
}
