<?php

namespace App\Repositories;

use App\Http\Resources\CountryResource;
use App\Models\Country;

class CountryRepository {
    const CACHE_KEY = "countries";

    public function getCacheKey($key)
    {
        $key = str_replace(" ","_", $key);
        return self::CACHE_KEY . "." . $key;
    }

    public function all()
    {
        $key = $this->getCacheKey('all');

        return cache()->remember($key, 0, function(){
            return CountryResource::collection(Country::all());
        });
    }
}
