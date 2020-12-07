<?php
namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;
class Task extends Model
{
    protected $table = 'tasks';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'author_id',
        'user_id',
        'project_id',
        'priority',
        'context',
        'title',
        'description',
        'deadline',
        'status',
        'visibility',
        'archived',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
	{
		parent::boot();
		static::creating(function ($query) {
            $query->author_id = Auth::user()->id;
            $query->archived = 'NO';
		});
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
    public function project()
    {
        return $this->belongsTo
        (
            'App\Project',
            'project_id',
            'id'
        )
        ->withDefault();
    }
}
