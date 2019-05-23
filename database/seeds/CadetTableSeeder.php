<?php

use Illuminate\Database\Seeder;
use Flurry\Cadet;

class CadetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cadet_names = [
            "Edgardo",
            "José",
            "Leonardo",
            "Javier",
            "Cristian",
            "Genérico",
            "Alfredo",
            "Elias",
        ];
        foreach($cadet_names as $cadet_name) {
            $cadet = new Cadet();
            $cadet->name = $cadet_name;
            $cadet->save();
        }
    }
}
