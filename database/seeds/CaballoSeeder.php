<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaballoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['cab_nombre' => 'Galán', 'cab_capa' => 'Cenizo', 'cab_nacimiento' => '20/03/2010', 'cab_semental' => 'Deferente PT', 'cab_fot1' => 'https://www.nationalgeographic.com.es/medio/2019/04/10/gee-rise-upgee-al-vuelo_ecadecf3_1333x2000.jpg', 'cab_fot2' => 'https://www.nationalgeographic.com.es/medio/2019/04/10/gee-rise-upgee-al-vuelo_ecadecf3_1333x2000.jpg', 'cab_fot3' => 'https://www.nationalgeographic.com.es/medio/2019/04/10/gee-rise-upgee-al-vuelo_ecadecf3_1333x2000.jpg', 'cab_video' => 'https://www.youtube.com/watch?v=zmr-G8iJxK0', 'fk_id_user' => 1, 'fk_id_finca' => 2],
            ['cab_nombre' => 'Ambicioso', 'cab_capa' => 'Negro', 'cab_nacimiento' => '04/03/2019', 'cab_semental' => 'Deferente PT', 'cab_fot1' => 'https://www.nationalgeographic.com.es/medio/2019/04/10/gee-rise-upgee-al-vuelo_ecadecf3_1333x2000.jpg', 'cab_fot2' => 'https://www.nationalgeographic.com.es/medio/2019/04/10/gee-rise-upgee-al-vuelo_ecadecf3_1333x2000.jpg', 'cab_fot3' => 'https://www.nationalgeographic.com.es/medio/2019/04/10/gee-rise-upgee-al-vuelo_ecadecf3_1333x2000.jpg', 'cab_video' => 'https://www.youtube.com/watch?v=zmr-G8iJxK0', 'fk_id_user' => 4, 'fk_id_finca' => 1],
            ['cab_nombre' => 'Lucki', 'cab_capa' => 'Rojo', 'cab_nacimiento' => '10/03/2020', 'cab_semental' => 'Deferente PT', 'cab_fot1' => 'https://www.nationalgeographic.com.es/medio/2019/04/10/gee-rise-upgee-al-vuelo_ecadecf3_1333x2000.jpg', 'cab_fot2' => 'https://www.nationalgeographic.com.es/medio/2019/04/10/gee-rise-upgee-al-vuelo_ecadecf3_1333x2000.jpg', 'cab_fot3' => 'https://www.nationalgeographic.com.es/medio/2019/04/10/gee-rise-upgee-al-vuelo_ecadecf3_1333x2000.jpg', 'cab_video' => 'https://www.youtube.com/watch?v=zmr-G8iJxK0', 'fk_id_user' => 3, 'fk_id_finca' => 3],
        ];

        //No verfica las llaves foraneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        //Vacia los registros
        DB::table('caballo')->truncate();

        foreach ($data as $item) {
            DB::table('caballo')->insert($item);
        }
    }
}
