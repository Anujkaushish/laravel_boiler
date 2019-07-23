<?php

namespace App\Repositories;

use App\Models\Cars;
use App\Repositories\BaseRepository;

/**
 * Class CarsRepository
 * @package App\Repositories
 * @version July 18, 2019, 10:57 am UTC
*/

class CarsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'maker',
        'model',
        'images'
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
        return Cars::class;
    }
}
