<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceptionImage extends Model
{
    protected $table = 'projects';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'reception_id',
        'image',
        'description',
        'created_at',
        'updated_at'
    ];
    public function reception()
    {
        return $this->belongsTo
        (
            'App\Reception',
            'reception_id',
            'id'
        )
        ->withDefault();
    }
}
