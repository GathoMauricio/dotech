<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Sale extends Model
{
    protected $table = 'sales';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'company_id',
        'department_id',
        'author_id',
        'status',
        'description',
        'investment',
        'estimated',
        'utility',
        'iva',
        'commision_percent',
        'commision_pay',
        'deadline',
        'delivery_days',
        'shipping',
        'payment_type',
        'credit',
        'currency',
        'observation',
        'material',
        'project_at',
        'finished_at',
        'closed_at',
        'created_at',
        'updated_at',
    ];
    protected static function boot()
	{
		parent::boot();

		static::creating(function ($query) {
            $query->author_id = \Auth::user()->id;
            //$query->investment = 0;
            $query->estimated = 0;
            $query->iva = 0;
            $query->utility = 0;
            $query->commision_percent = 0;
            $query->commision_pay = 0;
		});
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
