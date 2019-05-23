<?php

use Illuminate\Database\Seeder;
use Flurry\AreaCode;

class AreaCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area_code = new AreaCode();
        $area_code->international_code_id = config('ourconfig.international_codes.default_id', 1);
        $area_code->code = 11;
        $area_code->save();
    }
}
