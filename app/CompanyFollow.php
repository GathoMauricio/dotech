<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class CompanyFollow extends Model
{
    protected $table = 'company_follows';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'company_id',
        'author_id',
        'body',
        'tipo_seguimiento',
        'created_at',
        'updated_at',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->author_id = Auth::user()->id;
        });
    }
    public function company()
    {
        return $this->belongsTo(
                'App\Company',
                'company_id',
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
