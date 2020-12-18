<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class WhitdrawalAccount extends Model
{
    protected $table = 'whitdrawals';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'type',
        'balance',
        'number',
        'created_at',
        'updated_at',
    ];
}
