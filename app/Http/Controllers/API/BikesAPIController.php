<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBikesAPIRequest;
use App\Http\Requests\API\UpdateBikesAPIRequest;
use App\Models\Bikes;
use App\Repositories\BikesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BikesController
 * @package App\Http\Controllers\API
 */

class BikesAPIController extends AppBaseController
{
    /** @var  BikesRepository */
    private $bikesRepository;

    public function __construct(BikesRepository $bikesRepo)
    {
        $this->bikesRepository = $bikesRepo;
    }

    /**
     * Display a listing of the Bikes.
     * GET|HEAD /bikes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $bikes = $this->bikesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($bikes->toArray(), 'Bikes retrieved successfully');
    }

    /**
     * Store a newly created Bikes in storage.
     * POST /bikes
     *
     * @param CreateBikesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBikesAPIRequest $request)
    {
        $input = $request->all();

        $bikes = $this->bikesRepository->create($input);

        return $this->sendResponse($bikes->toArray(), 'Bikes saved successfully');
    }

    /**
     * Display the specified Bikes.
     * GET|HEAD /bikes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Bikes $bikes */
        $bikes = $this->bikesRepository->find($id);

        if (empty($bikes)) {
            return $this->sendError('Bikes not found');
        }

        return $this->sendResponse($bikes->toArray(), 'Bikes retrieved successfully');
    }

    /**
     * Update the specified Bikes in storage.
     * PUT/PATCH /bikes/{id}
     *
     * @param int $id
     * @param UpdateBikesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBikesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Bikes $bikes */
        $bikes = $this->bikesRepository->find($id);

        if (empty($bikes)) {
            return $this->sendError('Bikes not found');
        }

        $bikes = $this->bikesRepository->update($input, $id);

        return $this->sendResponse($bikes->toArray(), 'Bikes updated successfully');
    }

    /**
     * Remove the specified Bikes from storage.
     * DELETE /bikes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Bikes $bikes */
        $bikes = $this->bikesRepository->find($id);

        if (empty($bikes)) {
            return $this->sendError('Bikes not found');
        }

        $bikes->delete();

        return $this->sendResponse($id, 'Bikes deleted successfully');
    }
}
