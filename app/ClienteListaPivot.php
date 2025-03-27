<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteListaPivot extends Model
{
    use HasFactory;

    protected $table = 'cliente_lista_pivots';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'lista_id',
        'cliente_id',
    ];

    public function lista()
    {
        return $this->belongsTo(
            'App\MailingLista',
            'lista_id',
            'id'
        )
            ->withDefault();
    }

    public function cliente()
    {
        return $this->belongsTo(
            'App\Company',
            'cliente_id',
            'id'
        )
            ->withDefault();
    }
}
