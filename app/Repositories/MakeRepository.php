<?php

namespace App\Repositories;

use App\Http\Resources\MakeResource;
use App\Models\Make;

class MakeRepository {
    const CACHE_KEY = "makes";

    public function getCacheKey($key)
    {
        $key = str_replace(" ","_", $key);
        return self::CACHE_KEY . "." . $key;
    }

    public function all(){
        $key = $this->getCacheKey("all");
        return cache()->remember($key, 0, function(){
            $makes = Make::all();
            return MakeResource::collection($makes);
        });
    }
}
