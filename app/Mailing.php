<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailing extends Model
{
    use HasFactory;

    protected $table = 'mailings';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'subject',
        'from',
        'body',
        'selected',
    ];

    public function adjuntos()
    {
        return $this->hasMany('App\MailingAdjunto', 'mailing_id');
    }

    public function listas_pivot()
    {
        return $this->hasMany('App\MailingListaPivot', 'mailing_id');
    }
}
