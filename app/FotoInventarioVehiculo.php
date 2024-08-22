<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoInventarioVehiculo extends Model
{
    use HasFactory;

    protected $table = 'inventario_vehiculo_fotos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'autor_id',
        'inventario_id',
        'seccion',
        'foto',
        'descripcion',
        'source',
    ];

    public function autor()
    {
        return $this->belongsTo(
            'App\User',
            'autor_id',
            'id'
        )
            ->withDefault();
    }

    public function inventario()
    {
        return $this->belongsTo(
            'App\InventarioVehiculo',
            'inventario_id',
            'id'
        )
            ->withDefault();
    }
}
