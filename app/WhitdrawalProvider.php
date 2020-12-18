<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class WhitdrawalProvider extends Model
{
    protected $table = 'whitdrawal_providers';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'bank',
        'account',
        'pay_type',
        'rfc',
        'address',
        'manager',
        'phone',
        'created_at',
        'updated_at'
    ];
}
