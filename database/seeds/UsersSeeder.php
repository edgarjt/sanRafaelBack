<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['use_nombre' => 'root', 'use_app' => 'root', 'use_apm' => 'root', 'use_email' => 'root@sanrafael.com', 'use_password' => Hash::make('root'), 'use_telefono' => 1234567899, 'use_role' => 0]
        ];

        //No verfica las llaves foraneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        //Vacia los registros
        DB::table('users')->truncate();

        foreach ($data as $item) {
            DB::table('users')->insert($item);
        }
    }
}
