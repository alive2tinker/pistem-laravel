<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppraisalRequest;
use App\Http\Requests\StoreNewCar;
use Auth;
use App\Models\Car;
use App\Models\Modele;
use Illuminate\Http\Request;
use App\Repositories\CarRepository;

class CarController extends Controller
{
    public $repository;

    public function __construct()
    {
        $this->repository = new CarRepository();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewCar $request)
    {
        $car = Auth::user()->cars()->create($request->only('modele_id','city_id','mileage','price', 'details','for_sale'));
        if($request->input('for_sale'))
            $this->repository->add($car);

        return response()->json(trans("Car listed successfully"), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return $this->repository->get($car->id);
    }

    /**
     * Display the predicted value of a specified resource
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function calculate(AppraisalRequest $request)
    {

        return $this->repository->calculate($request->only('modele_id', 'mileage'));
    }
}
