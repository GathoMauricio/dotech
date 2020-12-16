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
        'closed_at',
        'created_at',
        'updated_at',
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
    public function department()
    {
        return $this->belongsTo
        (
            'App\Department',
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
