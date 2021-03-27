<?php

namespace App\Http\Controllers;

use App\Models\Make;
use Illuminate\Http\Request;
use App\Repositories\ModeleRepository;
class ModeleController extends Controller
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new ModeleRepository();
    }
    public function index(Make $make)
    {
        return $this->repository->all($make->id);
    }
}
