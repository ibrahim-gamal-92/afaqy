<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\ApiController;
use App\Services\HotelService;
use App\Services\VehicleService;
use App\Transformers\HotelTransformer;
use Illuminate\Http\Request;

class VehicleController extends ApiController
{

    protected $vehicleService;

    /**
     * HotelsController constructor.
     * @param HotelService $hotelService
     */
    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    public function index()
    {
        return $this->respond(['expenses'=>$this->vehicleService->getData()]);
    }
}
