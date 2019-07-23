<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCabsAPIRequest;
use App\Http\Requests\API\UpdateCabsAPIRequest;
use App\Models\Cabs;
use App\Repositories\CabsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CabsController
 * @package App\Http\Controllers\API
 */

class CabsAPIController extends AppBaseController
{
    /** @var  CabsRepository */
    private $cabsRepository;

    public function __construct(CabsRepository $cabsRepo)
    {
        $this->cabsRepository = $cabsRepo;
    }

    /**
     * Display a listing of the Cabs.
     * GET|HEAD /cabs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cabs = $this->cabsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cabs->toArray(), 'Cabs retrieved successfully');
    }

    /**
     * Store a newly created Cabs in storage.
     * POST /cabs
     *
     * @param CreateCabsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCabsAPIRequest $request)
    {
        $input = $request->all();

        $cabs = $this->cabsRepository->create($input);

        return $this->sendResponse($cabs->toArray(), 'Cabs saved successfully');
    }

    /**
     * Display the specified Cabs.
     * GET|HEAD /cabs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Cabs $cabs */
        $cabs = $this->cabsRepository->find($id);

        if (empty($cabs)) {
            return $this->sendError('Cabs not found');
        }

        return $this->sendResponse($cabs->toArray(), 'Cabs retrieved successfully');
    }

    /**
     * Update the specified Cabs in storage.
     * PUT/PATCH /cabs/{id}
     *
     * @param int $id
     * @param UpdateCabsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCabsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Cabs $cabs */
        $cabs = $this->cabsRepository->find($id);

        if (empty($cabs)) {
            return $this->sendError('Cabs not found');
        }

        $cabs = $this->cabsRepository->update($input, $id);

        return $this->sendResponse($cabs->toArray(), 'Cabs updated successfully');
    }

    /**
     * Remove the specified Cabs from storage.
     * DELETE /cabs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Cabs $cabs */
        $cabs = $this->cabsRepository->find($id);

        if (empty($cabs)) {
            return $this->sendError('Cabs not found');
        }

        $cabs->delete();

        return $this->sendResponse($id, 'Cabs deleted successfully');
    }
}
