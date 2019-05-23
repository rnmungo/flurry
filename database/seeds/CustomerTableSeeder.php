<?php

use Illuminate\Database\Seeder;
use Flurry\Customer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = new Customer();
        $customer->name = "Luciano Nicolás";
        $customer->lastname = "Horvath";
        $customer->area_code_phone_id = 1;
        $customer->phone = 48413511;
        $customer->area_code_mobile_id = 1;
        $customer->mobile = 40891905;
        $customer->email = "luciano@hotmail.com";
        $customer->street = "San Martín";
        $customer->street_number = 5416;
        $customer->locality_id = 3;
        $customer->latitude = "-34.55602190";
        $customer->longitude = "-58.59112550";
        $customer->facebook_nick = "Luciano Horvath";
        $customer->save();

        $customer = new Customer();
        $customer->name = "Rodrigo Nicolás";
        $customer->lastname = "Mungo";
        $customer->area_code_mobile_id = 1;
        $customer->mobile = 68065208;
        $customer->email = "rodrigomungo@gmail.com";
        $customer->street = "Calle Rosario";
        $customer->street_number = 3713;
        $customer->floor = 1;
        $customer->department = 1;
        $customer->between_street_one = "Agustín Alvarez";
        $customer->between_street_two = "Joaquín V. Gonzalez";
        $customer->locality_id = 2;
        $customer->facebook_nick = "rodrigo.mungo";
        $customer->instagram_nick = "rodrigo.mungo";
        $customer->save();
    }
}
