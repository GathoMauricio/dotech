<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\WithdrawalTransaction;
use Auth;

class Whitdrawal extends Model
{
    protected $table = 'whitdrawals';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'sale_id',
        'author_id',
        'folio',
        'emisor',
        'codigo_estatus',
        'es_cancelable',
        'estado_cfdi',
        'estatus_cancelacion',
        'whitdrawal_provider_id',
        'whitdrawal_account_id',
        'whitdrawal_department_id',
        'status',
        'type',
        'description',
        'quantity',
        'invoive',
        'document',
        'paid',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->author_id = \Auth::user()->id;
            $query->status = 'Pendiente';
        });
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
    public function provider()
    {
        return $this->belongsTo(
                'App\WhitdrawalProvider',
                'whitdrawal_provider_id',
                'id'
            )
            ->withDefault();
    }
    public function account()
    {
        return $this->belongsTo(
                'App\WhitdrawalAccount',
                'whitdrawal_account_id',
                'id'
            )
            ->withDefault();
    }
    public function department()
    {
        return $this->belongsTo(
                'App\WhitdrawalDepartment',
                'whitdrawal_department_id',
                'id'
            )
            ->withDefault();
    }
    public function transactions()
    {
        return $this->hasMany(WithdrawalTransaction::class);
    }
}
