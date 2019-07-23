<?php

namespace App\Repositories;

use App\Models\Cabs;
use App\Repositories\BaseRepository;

/**
 * Class CabsRepository
 * @package App\Repositories
 * @version July 18, 2019, 11:22 am UTC
*/

class CabsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'maker',
        'model',
        'image'
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
        return Cabs::class;
    }
}
