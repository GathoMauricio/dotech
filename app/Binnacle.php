<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Binnacle extends Model
{
    protected $table = 'binnacles';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'company_id',
        'sale_id',
        'author_id',
        'description',
        'firm',
        'feedbak',
        'email',
        'alias',
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
    public function company()
    {
        return $this->belongsTo(
            'App\Company',
            'company_id',
            'id'
        )
            ->withDefault();
    }
    public function sale()
    {
        return $this->belongsTo(
            'App\Sale',
            'sale_id',
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
