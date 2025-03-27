<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailingListaPivot extends Model
{
    use HasFactory;

    protected $table = 'mailing_lista_pivots';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'mailing_id',
        'lista_id',
    ];

    public function mailing()
    {
        return $this->belongsTo(
            'App\Mailing',
            'mailing_id',
            'id'
        )
            ->withDefault();
    }

    public function lista()
    {
        return $this->belongsTo(
            'App\MailingLista',
            'lista_id',
            'id'
        )
            ->withDefault();
    }
}
