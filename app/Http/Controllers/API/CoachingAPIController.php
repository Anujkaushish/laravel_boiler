<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCoachingAPIRequest;
use App\Http\Requests\API\UpdateCoachingAPIRequest;
use App\Models\Coaching;
use App\Repositories\CoachingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CoachingController
 * @package App\Http\Controllers\API
 */

class CoachingAPIController extends AppBaseController
{
    /** @var  CoachingRepository */
    private $coachingRepository;

    public function __construct(CoachingRepository $coachingRepo)
    {
        $this->coachingRepository = $coachingRepo;
    }

    /**
     * Display a listing of the Coaching.
     * GET|HEAD /coachings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $coachings = $this->coachingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($coachings->toArray(), 'Coachings retrieved successfully');
    }

    /**
     * Store a newly created Coaching in storage.
     * POST /coachings
     *
     * @param CreateCoachingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCoachingAPIRequest $request)
    {
        $input = $request->all();

        $coaching = $this->coachingRepository->create($input);

        return $this->sendResponse('Coaching saved successfully',$coaching);
    }

    /**
     * Display the specified Coaching.
     * GET|HEAD /coachings/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Coaching $coaching */
        $coaching = $this->coachingRepository->find($id);

        if (empty($coaching)) {
            return $this->sendError('Coaching not found');
        }

        return $this->sendResponse($coaching->toArray(), 'Coaching retrieved successfully');
    }

    /**
     * Update the specified Coaching in storage.
     * PUT/PATCH /coachings/{id}
     *
     * @param int $id
     * @param UpdateCoachingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCoachingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Coaching $coaching */
        $coaching = $this->coachingRepository->find($id);

        if (empty($coaching)) {
            return $this->sendError('Coaching not found');
        }

        $coaching = $this->coachingRepository->update($input, $id);

        return $this->sendResponse($coaching->toArray(), 'Coaching updated successfully');
    }

    /**
     * Remove the specified Coaching from storage.
     * DELETE /coachings/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Coaching $coaching */
        $coaching = $this->coachingRepository->find($id);

        if (empty($coaching)) {
            return $this->sendError('Coaching not found');
        }

        $coaching->delete();

        return $this->sendResponse($id, 'Coaching deleted successfully');
    }
}
