<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FincaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['fin_nombre' => 'San Rafael', 'fin_direccion' => 'Villahermosa', 'fin_horario' => '6:00 am - 5:00 pm'],
            ['fin_nombre' => 'Santa Elena', 'fin_direccion' => 'Jonuta', 'fin_horario' => '6:00 am - 5:00 pm'],
            ['fin_nombre' => 'La soledad', 'fin_direccion' => 'Palizada', 'fin_horario' => '6:00 am - 5:00 pm'],
        ];

        //No verfica las llaves foraneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        //Vacia los registros
        DB::table('finca')->truncate();

        foreach ($data as $item) {
            DB::table('finca')->insert($item);
        }
    }
}
