<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailingLista extends Model
{
    use HasFactory;

    protected $table = 'mailing_listas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function clientes_pivot()
    {
        return $this->hasMany(ClienteListaPivot::class, 'lista_id', 'id');
    }
}
