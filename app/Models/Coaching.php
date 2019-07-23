<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Coaching
 * @package App\Models
 * @version July 22, 2019, 12:32 pm UTC
 *
 * @property \App\Models\User user
 * @property string class
 * @property integer stud_id
 * @property integer tech_id
 */
class Coaching extends Model
{

    public $table = 'coachings';
    


    public $fillable = [
        'class',
        'stud_id',
        'tech_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'class' => 'string',
        'stud_id' => 'integer',
        'tech_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'class' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'tech_id');
    }
}
