<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Cabs
 * @package App\Models
 * @version July 18, 2019, 11:22 am UTC
 *
 * @property string maker
 * @property string model
 * @property string image
 */
class Cabs extends Model
{

    public $table = 'cabs';
    


    public $fillable = [
        'maker',
        'model',
        'image'
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
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'maker' => 'required',
        'model' => 'required',
        'image' => 'required'
    ];

    
}
