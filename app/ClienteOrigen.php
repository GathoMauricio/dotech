<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteOrigen extends Model
{
    use HasFactory;

    protected $table = 'cliente_origens';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'author_id',
        'origen'
    ];

    public function author()
    {
        return $this->belongsTo(
            'App\User',
            'author_id',
            'id'
        )
            ->withDefault();
    }
}
