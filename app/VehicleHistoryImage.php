<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleHistoryImage extends Model
{
    protected $table = 'vehicle_history_images';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id',
        'vehicle_history_id',
        'image',
        'description',
        'created_at',
        'updated_at'
    ];
    public function history()
    {
        return $this->belongsTo
        (
            'App\vehicle_history_id',
            'vehicle_id',
            'id'
        )
        ->withDefault();
    }
}
