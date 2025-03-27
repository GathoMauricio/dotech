<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailingAdjunto extends Model
{
    use HasFactory;

    protected $table = 'mailing_adjuntos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'mailing_id',
        'ruta',
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
}
