<?php
#TODO Las funciones con nombre en inglés se eliminaran cuando se reemplacen las vistas que usan esas relaciones
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProjectTransaction;

class Sale extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'folio_cotizacion',
        'folio_proyecto',
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
        return $this->belongsTo(
            'App\Company',
            'company_id',
            'id'
        )
            ->withDefault();
    }

    public function cliente()
    {
        return $this->belongsTo(
            'App\Company',
            'company_id',
            'id'
        )
            ->withDefault();
    }

    public function department()
    {
        return $this->belongsTo(
            'App\CompanyDepartment',
            'department_id',
            'id'
        )
            ->withDefault();
    }

    public function departamento()
    {
        return $this->belongsTo(
            'App\CompanyDepartment',
            'department_id',
            'id'
        )
            ->withDefault();
    }

    public function author()
    {
        return $this->belongsTo(
            'App\User',
            'author_id',
            'id'
        )
            ->withDefault();
    }

    public function autor()
    {
        return $this->belongsTo(
            'App\User',
            'author_id',
            'id'
        )
            ->withDefault();
    }

    public function transactions()
    {
        return $this->hasMany(ProjectTransaction::class);
    }

    public function transacciones()
    {
        return $this->hasMany(ProjectTransaction::class);
    }

    public function productos()
    {
        return $this->hasMany(ProductSale::class);
    }

    public function pagos()
    {
        return $this->hasMany(SalePayment::class);
    }

    public function archivos()
    {
        return $this->hasMany(SaleDocument::class);
    }

    public function retiros()
    {
        return $this->hasMany(Whitdrawal::class);
    }

    public function bitacoras()
    {
        return $this->hasMany(Binnacle::class);
    }

    public function seguimientos()
    {
        return $this->hasMany(SaleFollow::class);
    }
}
