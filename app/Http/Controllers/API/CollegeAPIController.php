<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCollegeAPIRequest;
use App\Http\Requests\API\UpdateCollegeAPIRequest;
use App\Models\College;
use App\Repositories\CollegeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CollegeController
 * @package App\Http\Controllers\API
 */

class CollegeAPIController extends AppBaseController
{
    /** @var  CollegeRepository */
    private $collegeRepository;

    public function __construct(CollegeRepository $collegeRepo)
    {
        $this->collegeRepository = $collegeRepo;
    }

    /**
     * Display a listing of the College.
     * GET|HEAD /colleges
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $colleges = $this->collegeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($colleges->toArray(), 'Colleges retrieved successfully');
    }

    /**
     * Store a newly created College in storage.
     * POST /colleges
     *
     * @param CreateCollegeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCollegeAPIRequest $request)
    {
        $input = $request->all();

        $college = $this->collegeRepository->create($input);

        return $this->sendResponse($college->toArray(), 'College saved successfully');
    }

    /**
     * Display the specified College.
     * GET|HEAD /colleges/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var College $college */
        $college = $this->collegeRepository->find($id);

        if (empty($college)) {
            return $this->sendError('College not found');
        }

        return $this->sendResponse($college->toArray(), 'College retrieved successfully');
    }

    /**
     * Update the specified College in storage.
     * PUT/PATCH /colleges/{id}
     *
     * @param int $id
     * @param UpdateCollegeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCollegeAPIRequest $request)
    {
        $input = $request->all();

        /** @var College $college */
        $college = $this->collegeRepository->find($id);

        if (empty($college)) {
            return $this->sendError('College not found');
        }

        $college = $this->collegeRepository->update($input, $id);

        return $this->sendResponse($college->toArray(), 'College updated successfully');
    }

    /**
     * Remove the specified College from storage.
     * DELETE /colleges/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var College $college */
        $college = $this->collegeRepository->find($id);

        if (empty($college)) {
            return $this->sendError('College not found');
        }

        $college->delete();

        return $this->sendResponse($id, 'College deleted successfully');
    }
}
