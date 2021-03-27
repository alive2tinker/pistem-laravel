<?php
namespace App\Repositories;

use App\Http\Resources\ModeleResource;
use App\Models\Modele;

class ModeleRepository {

    const CACHE_KEY = 'modeles';

    public function getCacheKey($key)
    {
        $key = str_replace(" ","_", $key);
        return self::CACHE_KEY . "." . $key;
    }

    public function all($make_id){
        $key = $this->getCacheKey("all." . $make_id);
        return cache()->remember($key, 0, function() use($make_id){
            $modeles = Modele::where('make_id',$make_id)->orderby('created_at','desc')->paginate(10);
            return ModeleResource::collection($modeles);
        });
    }

    public function get($id){
        $key = $this->getCacheKey("get.{$id}");

        return cache()->remember($key, 0, function() use($id){
            $modele = Modele::find($id);
            return new ModeleResource($modele);
        });
    }
}
