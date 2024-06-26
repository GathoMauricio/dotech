<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDocument extends Model
{
    use HasFactory;

    protected $table = 'company_documents';
	protected $primaryKey = 'id';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'company_id',
        'author_id',
        'description',
        'document',
        'created_at',
        'updated_at',
    ];
    protected static function boot()
	{
		parent::boot();

		static::creating(function ($query) {
			$query->author_id = \Auth::user()->id;
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
