<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class School
 * @package App\Models
 * @version July 22, 2019, 8:01 am UTC
 *
 * @property \App\Models\User user
 * @property string students
 * @property string email
 * @property integer stud_id
 */
class School extends Model
{

    public $table = 'schools';
    


    public $fillable = [
        'students',
        'email',
        'stud_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'students' => 'string',
        'email' => 'string',
        'stud_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'students' => 'required',
        'email' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'stud_id');
    }
}
