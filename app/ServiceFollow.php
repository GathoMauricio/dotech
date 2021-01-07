<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class ServiceFollow extends Model
{
    protected $table = 'service_follows';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'service_id',
        'author_id',
        'body',
        'created_at',
        'updated_at'
    ];
    public function service()
    {
        return $this->belongsTo
        (
            'App\Service',
            'service_id',
            'id'
        )
        ->withDefault();
    }
    public function author()
    {
        return $this->belongsTo
        (
            'App\User',
            'author_id',
            'id'
        )
        ->withDefault();
    }
}
