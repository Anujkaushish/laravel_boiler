<?php

namespace App\Repositories;

use App\Models\Coaching;
use App\Repositories\BaseRepository;

/**
 * Class CoachingRepository
 * @package App\Repositories
 * @version July 22, 2019, 12:32 pm UTC
*/

class CoachingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'class',
        'stud_id',
        'tech_id'
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
        return Coaching::class;
    }
    public function create($input)
    {
        $input['tech_id']= auth()->user()->id;
        $model=$this->model->newInstance($input);
        $model->save();
        return $model;

    }
}
