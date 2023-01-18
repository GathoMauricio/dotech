<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalTransaction extends Model
{
    use HasFactory;

    protected $table = 'whitdrawal_transactions';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'whitdrawal_id',
        'transaction_id'
    ];

    public function whitdrawal()
    {
        return $this->belongsTo
        (
            'App\Whitdrawal',
            'whitdrawal_id',
            'id'
        )
        ->withDefault();
    }

    public function transaction()
    {
        return $this->belongsTo
        (
            'App\Transaction',
            'transaction_id',
            'id'
        )
        ->withDefault();
    }
}
