<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CadetTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(TasteTableSeeder::class);
        $this->call(InternationalCodesTableSeeder::class);
        $this->call(AreaCodesTableSeeder::class);
        $this->call(LocalityTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
