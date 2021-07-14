<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class BinnacleImage extends Model
{
    protected $table = 'binnacle_images';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'binnacle_id',
        'author_id',
        'image',
        'description',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->author_id = Auth::user()->id;
        });
    }
    public function binnacle()
    {
        return $this->belongsTo(
                'App\Binnacle',
                'binnacle_id',
                'id'
            )
            ->withDefault();
    }
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
