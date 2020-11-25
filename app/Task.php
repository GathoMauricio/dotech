<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'user_id',
        'project_id',
        'priority',
        'context',
        'title',
        'description',
        'deadline',
        'status',
        'visibility',
        'created_at',
        'updated_at'
    ];

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
