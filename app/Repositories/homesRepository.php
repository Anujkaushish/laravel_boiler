<?php

namespace App\Repositories;

use App\Models\homes;
use App\Repositories\BaseRepository;

/**
 * Class homesRepository
 * @package App\Repositories
 * @version July 19, 2019, 1:31 pm UTC
*/

class homesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'room'
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
        return homes::class;
    }
}
