<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Modele;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modele = Modele::find(2);
        $i = 0;
        while($i <= 1000){
            $modele->cars()->create([
                'mileage' => rand(50000, 300000),
                'price' => rand(30000, 70000),
                'city_id' => 1
            ]);
            $i++;
        }
    }
}
