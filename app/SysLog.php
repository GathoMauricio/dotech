<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class SysLog extends Model
{
    protected $table = 'sys_logs';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'body',
        'created_at',
        'updated_at'
    ];
}
