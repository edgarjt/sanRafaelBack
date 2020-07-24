<?php

use Illuminate\Database\Seeder;

class YeguaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['yeg_nombre' => 'África', 'yeg_capa' => 'blanco', 'yeg_nacimiento' => '20/03/2010', 'yeg_semental' => 'Deferente PT', 'yeg_fot1' => 'https://www.nationalgeographic.com.es/medio/2018/07/11/jennifer-gates_8df58931.jpg', 'yeg_fot2' => 'https://www.nationalgeographic.com.es/medio/2019/04/10/gee-rise-upgee-al-vuelo_ecadecf3_1333x2000.jpg', 'yeg_fot3' => 'https://www.nationalgeographic.com.es/medio/2018/07/11/jennifer-gates_8df58931.jpg', 'yeg_video' => 'https://www.youtube.com/watch?v=zmr-G8iJxK0', 'fk_id_user' => 2, 'fk_id_finca' => 1],
            ['yeg_nombre' => 'Alabama', 'yeg_capa' => 'Rojo', 'yeg_nacimiento' => '04/03/2019', 'yeg_semental' => 'Deferente PT', 'yeg_fot1' => 'https://www.nationalgeographic.com.es/medio/2018/07/11/jennifer-gates_8df58931.jpg', 'yeg_fot2' => 'https://www.nationalgeographic.com.es/medio/2019/04/10/gee-rise-upgee-al-vuelo_ecadecf3_1333x2000.jpg', 'yeg_fot3' => 'https://www.nationalgeographic.com.es/medio/2018/07/11/jennifer-gates_8df58931.jpg', 'yeg_video' => 'https://www.youtube.com/watch?v=zmr-G8iJxK0', 'fk_id_user' => 1, 'fk_id_finca' => 2],
            ['yeg_nombre' => 'Gitana', 'yeg_capa' => 'Gris', 'yeg_nacimiento' => '10/03/2020', 'yeg_semental' => 'Deferente PT', 'yeg_fot1' => 'https://www.nationalgeographic.com.es/medio/2018/07/11/jennifer-gates_8df58931.jpg', 'yeg_fot2' => 'https://www.nationalgeographic.com.es/medio/2019/04/10/gee-rise-upgee-al-vuelo_ecadecf3_1333x2000.jpg', 'yeg_fot3' => 'hhttps://www.nationalgeographic.com.es/medio/2018/07/11/jennifer-gates_8df58931.jpg', 'yeg_video' => 'https://www.youtube.com/watch?v=zmr-G8iJxK0', 'fk_id_user' => 5, 'fk_id_finca' => 3],
        ];

        //No verfica las llaves foraneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        //Vacia los registros
        DB::table('yegua')->truncate();

        foreach ($data as $item) {
            DB::table('yegua')->insert($item);
        }
    }
}
