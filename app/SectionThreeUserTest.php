<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionThreeUserTest extends Model
{
    protected $table = 'section_three_user_tests';
	protected $primaryKey = 'id';
	public $timestamps = true;

    protected $fillable = [
        'id','user_id',
        'question_1','question_2','question_3','question_4','question_5',
        'question_6','question_7','question_8','question_9','question_10',
        'question_11','question_12','question_13','question_14','question_15',
        'question_16','question_17','question_18',
        'created_at','updated_at',
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
}
