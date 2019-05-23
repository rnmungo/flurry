<?php

use Illuminate\Database\Seeder;
use Flurry\Locality;

class LocalityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locality_names = array('Ramos Mejía', 'Villa Ballester', 'Loma Hermosa', 'San Martín');
        foreach($locality_names as $locality_name) {
            $locality = new Locality();
            $locality->name = $locality_name;
            $locality->save();
        }
    }
}
