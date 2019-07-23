<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class homes
 * @package App\Models
 * @version July 19, 2019, 1:31 pm UTC
 *
 * @property string room
 */
class homes extends Model
{

    public $table = 'homes';
    


    public $fillable = [
        'room'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'room' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'room' => 'required'
    ];

    
}
