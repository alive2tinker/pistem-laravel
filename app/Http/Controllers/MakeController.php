<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MakeRepository;

class MakeController extends Controller
{

    protected $repository;

    public function __construct()
    {
        $this->repository = new MakeRepository();
    }
    public function index()
    {
        return $this->repository->all();
    }
}
