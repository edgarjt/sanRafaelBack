<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['inf_logo' => 'http://yeguadasanrafael.com/img/logo.png', 'inf_telefono' => 9988776655, 'inf_email' => 'sanrafael@email.com', 'inf_historia' => 'Esta es una historia inicial', 'fk_id_user' => 2]
        ];

        //No verfica las llaves foraneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        //Vacia los registros
        DB::table('infoWeb')->truncate();

        foreach ($data as $item) {
            DB::table('infoWeb')->insert($item);
        }
    }
}
