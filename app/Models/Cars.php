<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Cars
 * @package App\Models
 * @version July 18, 2019, 10:57 am UTC
 *
 * @property string maker
 * @property string model
 * @property string images
 */
class Cars extends Model
{

    public $table = 'cars';
    


    public $fillable = [
        'maker',
        'model',
        'images'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'maker' => 'string',
        'model' => 'string',
        'images' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'maker' => 'required',
        'model' => 'required',
        'images' => 'required'
    ];

    
}
