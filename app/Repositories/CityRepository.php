<?php
namespace App\Repositories;

use App\Http\Resources\CityResource;

class CityRepository {

    const CACHE_KEY = "cities";
    public function getCacheKey($key)
    {
        $key = str_replace(" ","_", $key);
        return self::CACHE_KEY . "." . $key;
    }

    public function all($country){
        $key = $this->getCacheKey($country->name .".cities");
        return cache()->remember($key, 0, function() use($country) {
            return CityResource::collection($country->cities);
        });
    }
}
