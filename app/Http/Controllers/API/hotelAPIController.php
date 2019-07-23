<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatehotelAPIRequest;
use App\Http\Requests\API\UpdatehotelAPIRequest;
use App\Models\hotel;
use App\Repositories\hotelRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class hotelController
 * @package App\Http\Controllers\API
 */

class hotelAPIController extends AppBaseController
{
    /** @var  hotelRepository */
    private $hotelRepository;

    public function __construct(hotelRepository $hotelRepo)
    {
        $this->hotelRepository = $hotelRepo;
    }

    /**
     * Display a listing of the hotel.
     * GET|HEAD /hotels
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $hotels = $this->hotelRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($hotels->toArray(), 'Hotels retrieved successfully');
    }

    /**
     * Store a newly created hotel in storage.
     * POST /hotels
     *
     * @param CreatehotelAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatehotelAPIRequest $request)
    {
        $input = $request->all();

        $hotel = $this->hotelRepository->create($input);

        return $this->sendResponse($hotel->toArray(), 'Hotel saved successfully');
    }

    /**
     * Display the specified hotel.
     * GET|HEAD /hotels/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var hotel $hotel */
        $hotel = $this->hotelRepository->find($id);

        if (empty($hotel)) {
            return $this->sendError('Hotel not found');
        }

        return $this->sendResponse($hotel->toArray(), 'Hotel retrieved successfully');
    }

    /**
     * Update the specified hotel in storage.
     * PUT/PATCH /hotels/{id}
     *
     * @param int $id
     * @param UpdatehotelAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatehotelAPIRequest $request)
    {
        $input = $request->all();

        /** @var hotel $hotel */
        $hotel = $this->hotelRepository->find($id);

        if (empty($hotel)) {
            return $this->sendError('Hotel not found');
        }

        $hotel = $this->hotelRepository->update($input, $id);

        return $this->sendResponse($hotel->toArray(), 'hotel updated successfully');
    }

    /**
     * Remove the specified hotel from storage.
     * DELETE /hotels/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var hotel $hotel */
        $hotel = $this->hotelRepository->find($id);

        if (empty($hotel)) {
            return $this->sendError('Hotel not found');
        }

        $hotel->delete();

        return $this->sendResponse($id, 'Hotel deleted successfully');
    }
}
