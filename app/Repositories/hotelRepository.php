<?php

namespace App\Repositories;

use App\Models\hotel;
use App\Repositories\BaseRepository;

/**
 * Class hotelRepository
 * @package App\Repositories
 * @version July 22, 2019, 5:28 am UTC
*/

class hotelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'staff_id',
        'rooms'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return hotel::class;
    }
}
