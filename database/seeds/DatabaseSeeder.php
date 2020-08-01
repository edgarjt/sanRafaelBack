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
        $this->call(UsersSeeder::class);
        //$this->call(CaballoSeeder::class);
        $this->call(FincaSeeder::class);
        $this->call(InfoWebSeeder::class);
        //$this->call(SliderSeeder::class);
        //$this->call(YeguaSeeder::class);
    }
}
