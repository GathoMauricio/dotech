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
}
