<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTransaction extends Model
{
    use HasFactory;

    protected $table = 'project_transactions';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'sale_id',
        'transaction_id'
    ];

    public function project()
    {
        return $this->belongsTo
        (
            'App\Sale',
            'sale_id',
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
