<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class College
 * @package App\Models
 * @version July 22, 2019, 8:10 am UTC
 *
 * @property \App\Models\User user
 * @property string b.tech
 * @property integer stu_id
 */
class College extends Model
{

    public $table = 'colleges';
    


    public $fillable = [
        'b.tech',
        'stu_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'b.tech' => 'string',
        'stu_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'b.tech' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'stu_id');
    }
}
