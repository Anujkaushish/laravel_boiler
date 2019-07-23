<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatehomesAPIRequest;
use App\Http\Requests\API\UpdatehomesAPIRequest;
use App\Models\homes;
use App\Repositories\homesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class homesController
 * @package App\Http\Controllers\API
 */

class homesAPIController extends AppBaseController
{
    /** @var  homesRepository */
    private $homesRepository;

    public function __construct(homesRepository $homesRepo)
    {
        $this->homesRepository = $homesRepo;
    }

    /**
     * Display a listing of the homes.
     * GET|HEAD /homes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $homes = $this->homesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($homes->toArray(), 'Homes retrieved successfully');
    }

    /**
     * Store a newly created homes in storage.
     * POST /homes
     *
     * @param CreatehomesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatehomesAPIRequest $request)
    {
        $input = $request->all();

        $homes = $this->homesRepository->create($input);

        return $this->sendResponse($homes->toArray(), 'Homes saved successfully');
    }

    /**
     * Display the specified homes.
     * GET|HEAD /homes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var homes $homes */
        $homes = $this->homesRepository->find($id);

        if (empty($homes)) {
            return $this->sendError('Homes not found');
        }

        return $this->sendResponse($homes->toArray(), 'Homes retrieved successfully');
    }

    /**
     * Update the specified homes in storage.
     * PUT/PATCH /homes/{id}
     *
     * @param int $id
     * @param UpdatehomesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatehomesAPIRequest $request)
    {
        $input = $request->all();

        /** @var homes $homes */
        $homes = $this->homesRepository->find($id);

        if (empty($homes)) {
            return $this->sendError('Homes not found');
        }

        $homes = $this->homesRepository->update($input, $id);

        return $this->sendResponse($homes->toArray(), 'homes updated successfully');
    }

    /**
     * Remove the specified homes from storage.
     * DELETE /homes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var homes $homes */
        $homes = $this->homesRepository->find($id);

        if (empty($homes)) {
            return $this->sendError('Homes not found');
        }

        $homes->delete();

        return $this->sendResponse($id, 'Homes deleted successfully');
    }
}
