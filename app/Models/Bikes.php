<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Bikes
 * @package App\Models
 * @version July 18, 2019, 6:15 am UTC
 *
 * @property string model
 * @property string maker
 * @property string year
 */
class Bikes extends Model
{

    public $table = 'bikes';
    


    public $fillable = [
        'model',
        'maker',
        'year'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'model' => 'string',
        'maker' => 'string',
        'year' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'model' => 'required',
        'maker' => 'required',
        'year' => 'required'
    ];

    
}
