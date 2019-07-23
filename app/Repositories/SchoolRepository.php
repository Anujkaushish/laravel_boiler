<?php

namespace App\Repositories;

use App\Models\School;
use App\Repositories\BaseRepository;

/**
 * Class SchoolRepository
 * @package App\Repositories
 * @version July 22, 2019, 8:01 am UTC
*/

class SchoolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'students',
        'email',
        'stud_id'
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
        return School::class;
    }
}
