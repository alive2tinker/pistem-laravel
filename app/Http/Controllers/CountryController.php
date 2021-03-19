<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CountryRepository;

class CountryController extends Controller
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new CountryRepository();
    }
    public function index()
    {
        return $this->repository->all();
    }
}
