<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class CompanyDepartment extends Model
{
    protected $table = 'company_department';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'company_id',
        'name',
        'manager',
        'email',
        'phone',
        'address',
        'created_at',
        'updated_at'
    ];
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
}
