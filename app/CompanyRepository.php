<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyRepository extends Model
{
    protected $table = 'company_repositories';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'company_id',
        'title',
        'body',
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
