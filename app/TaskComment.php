<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Auth;
class TaskComment extends Model
{
    protected $table = 'tasks_comments';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'task_id',
        'user_id',
        'body',
        'created_at',
        'updated_at'
    ];

    protected static function boot()
	{
		parent::boot();

		static::creating(function ($query) {
			$query->user_id = Auth::user()->id;
		});
	}
    
    public function task()
    {
        return $this->belongsTo
        (
            'App\Task',
            'task_id',
            'id'
        )
        ->withDefault();
    }

    public function user()
    {
        return $this->belongsTo
        (
            'App\User',
            'user_id',
            'id'
        )
        ->withDefault();
    }
}
