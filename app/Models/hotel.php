<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class hotel
 * @package App\Models
 * @version July 22, 2019, 5:28 am UTC
 *
 * @property \App\Models\Bikes bikes
 * @property string staff_id
 * @property string rooms
 */
class hotel extends Model
{

    public $table = 'hotels';
    


    public $fillable = [
        'staff_id',
        'rooms'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'staff_id' => 'string',
        'rooms' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'staff_id' => 'required',
        'rooms' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function bikes()
    {
        return $this->hasOne(\App\Models\Bikes::class, 'id', 'staff_id');
    }
}
