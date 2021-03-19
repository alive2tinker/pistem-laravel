<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Repositories\CityRepository;

class CityController extends Controller
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new CityRepository();
    }

    public function index(Country $country)
    {
        return $this->repository->all($country);
    }
}
