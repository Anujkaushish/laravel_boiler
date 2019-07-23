<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCarsAPIRequest;
use App\Http\Requests\API\UpdateCarsAPIRequest;
use App\Models\Cars;
use App\Repositories\CarsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CarsController
 * @package App\Http\Controllers\API
 */

class CarsAPIController extends AppBaseController
{
    /** @var  CarsRepository */
    private $carsRepository;

    public function __construct(CarsRepository $carsRepo)
    {
        $this->carsRepository = $carsRepo;
    }

    /**
     * Display a listing of the Cars.
     * GET|HEAD /cars
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cars = $this->carsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cars->toArray(), 'Cars retrieved successfully');
    }

    /**
     * Store a newly created Cars in storage.
     * POST /cars
     *
     * @param CreateCarsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCarsAPIRequest $request)
    {
        $input = $request->all();

        $cars = $this->carsRepository->create($input);

        return $this->sendResponse($cars->toArray(), 'Cars saved successfully');
    }

    /**
     * Display the specified Cars.
     * GET|HEAD /cars/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Cars $cars */
        $cars = $this->carsRepository->find($id);

        if (empty($cars)) {
            return $this->sendError('Cars not found');
        }

        return $this->sendResponse($cars->toArray(), 'Cars retrieved successfully');
    }

    /**
     * Update the specified Cars in storage.
     * PUT/PATCH /cars/{id}
     *
     * @param int $id
     * @param UpdateCarsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCarsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Cars $cars */
        $cars = $this->carsRepository->find($id);

        if (empty($cars)) {
            return $this->sendError('Cars not found');
        }

        $cars = $this->carsRepository->update($input, $id);

        return $this->sendResponse($cars->toArray(), 'Cars updated successfully');
    }

    /**
     * Remove the specified Cars from storage.
     * DELETE /cars/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Cars $cars */
        $cars = $this->carsRepository->find($id);

        if (empty($cars)) {
            return $this->sendError('Cars not found');
        }

        $cars->delete();

        return $this->sendResponse($id, 'Cars deleted successfully');
    }
}
