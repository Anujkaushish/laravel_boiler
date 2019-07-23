<?php

namespace App\Repositories;

use App\Models\College;
use App\Repositories\BaseRepository;

/**
 * Class CollegeRepository
 * @package App\Repositories
 * @version July 22, 2019, 8:10 am UTC
*/

class CollegeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'b.tech',
        'stu_id'
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
        return College::class;
    }
}
