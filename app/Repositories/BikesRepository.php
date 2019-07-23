<?php

namespace App\Repositories;

use App\Models\Bikes;
use App\Repositories\BaseRepository;

/**
 * Class BikesRepository
 * @package App\Repositories
 * @version July 18, 2019, 6:15 am UTC
*/

class BikesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'model',
        'maker',
        'year'
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
        return Bikes::class;
    }
}
