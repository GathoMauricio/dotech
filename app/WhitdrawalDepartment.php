<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class WhitdrawalDepartment extends Model
{
    protected $table = 'whitdrawal_departments';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'name'
    ];
}
