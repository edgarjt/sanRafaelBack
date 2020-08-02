<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['sli_nombre' => 'slide1', 'sli_link' => 'http://yeguadasanrafael.net/yeguadaSanRafaelBack/storage/app/public/slid/slider.mp4', 'fk_id_user' => 1]
        ];

        //No verfica las llaves foraneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        //Vacia los registros
        DB::table('slider')->truncate();

        foreach ($data as $item) {
            DB::table('slider')->insert($item);
        }
    }
}
