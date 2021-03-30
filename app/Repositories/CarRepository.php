<?php

namespace App\Repositories;

use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\Modele;

class CarRepository {
    const CACHE_KEY = "cars";

    public function getCacheKey($key)
    {
        $key = str_replace(" ","_", $key);
        return self::CACHE_KEY . "." . $key;
    }

    public function all(){
        $key = $this->getCacheKey("for_sale");
        return cache()->remember($key, 0, function(){
            $cars = Car::with(['user','city','modele'])->where('for_sale', 1)->orderby('created_at','desc')->paginate(10);
            return CarResource::collection($cars);
        });
    }

    public function get($id){
        $key = $this->getCacheKey("get.{$id}");

        return cache()->remember($key, 0, function() use($id){
            $car = Car::with(['user','city','modele'])->find($id);
            return new CarResource($car);
        });
    }

    public function add($car){
        $key = $this->getCacheKey("for_sale");

        return cache()->add($key, $car, 0);
    }

    public function calculate($input){
        $key = $this->getCacheKey("calculate-" . $input['modele_id']);

        return cache()->remember($key, 86400, function() use($input){
            $data = [];
        $modele = Modele::find($input['modele_id']);
        $cars = Modele::find($input['modele_id'])->cars;
        if(count($cars) <= 1){
            if($input['mileage'] <= ($cars->first()->mileage + 1000)){
                $data['value'] = $cars->first()->price;
                return $data;
            }else{
                $data['value'] = 0;
                return $data;
            }
        }else{
            $ex = $cars->sum('mileage');
            $ey = $cars->sum('price');
            $ex2 = 0;
            $exy = 0;
            $n = count($cars);

            foreach($cars as $car){
                $exy = $exy + ($car->mileage * $car->price);
                $ex2 = $ex2 + pow($car->mileage, 2);
            }

            $a = (($ey * $ex2) - ($ex * $exy)) / (($n * $ex2) - pow($ex, 2));
            $b = (($n * $exy) - ($ex*$ey)) / (($n * $ex2) - pow($ex, 2));

            $value = $a + ($b * $input['mileage']);
            $data['picture'] = $modele->picture;
            $data['value'] = $value;
        }
        return response()->json($data, 200);
        });
    }
}
