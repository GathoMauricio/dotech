<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Service extends Model
{
    protected $table = 'services';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'author_id',
        'technical_id',
        'location_id',
        'company_id',
        'department_id',
        'status',
        'type',
        'subject',
        'description',
        'feedback',
        'programed_at',
        'contacted_at',
        'closed_at',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
	{
		parent::boot();

		static::creating(function ($query) {
            $query->author_id = Auth::user()->id;
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
    public function technical()
    {
        return $this->belongsTo
        (
            'App\User',
            'technical_id',
            'id'
        )
        ->withDefault();
    }
    public function location()
    {
        return $this->belongsTo
        (
            'App\ServiceLocation',
            'location_id',
            'id'
        )
        ->withDefault();
    }
    public function company()
    {
        return $this->belongsTo
        (
            'App\Company',
            'company_id',
            'id'
        )
        ->withDefault();
    }
    public function department()
    {
        return $this->belongsTo
        (
            'App\CompanyDepartment',
            'department_id',
            'id'
        )
        ->withDefault();
    }
}
