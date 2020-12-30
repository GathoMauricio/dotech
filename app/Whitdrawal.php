<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Whitdrawal extends Model
{
    protected $table = 'whitdrawals';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'sale_id',
        'whitdrawal_provider_id',
        'whitdrawal_account_id',
        'whitdrawal_department_id',
        'status',
        'type',
        'description',
        'quantity',
        'invoive',
        'document',
        'created_at',
        'updated_at'
    ];
    public function sale()
    {
        return $this->belongsTo
        (
            'App\Sale',
            'sale_id',
            'id'
        )
        ->withDefault();
    }
    public function provider()
    {
        return $this->belongsTo
        (
            'App\WhitdrawalProvider',
            'whitdrawal_provider_id',
            'id'
        )
        ->withDefault();
    }
    public function account()
    {
        return $this->belongsTo
        (
            'App\WhitdrawalAccount',
            'whitdrawal_account_id',
            'id'
        )
        ->withDefault();
    }
    public function department()
    {
        return $this->belongsTo
        (
            'App\WhitdrawalDepartment',
            'whitdrawal_department_id',
            'id'
        )
        ->withDefault();
    }
}
