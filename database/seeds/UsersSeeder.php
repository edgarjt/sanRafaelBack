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
            ['use_nombre' => 'root', 'use_app' => 'root', 'use_apm' => 'root', 'use_email' => 'root@sanrafael.com', 'use_password' => Hash::make('root'), 'use_telefono' => 1234567899, 'use_role' => 0],
            ['use_nombre' => 'Aitor', 'use_app' => 'Gómez', 'use_apm' => 'Fernandez', 'use_email' => 'aitor@test.com', 'use_password' => Hash::make('12345678'), 'use_telefono' => 6189467826, 'use_role' => 1],
            ['use_nombre' => 'Alan', 'use_app' => 'López', 'use_apm' => 'Romero', 'use_email' => 'alan@test.com', 'use_password' => Hash::make('12345678'), 'use_telefono' => 8009122328, 'use_role' => 1],
            ['use_nombre' => 'Alberto', 'use_app' => 'Díaz', 'use_apm' => 'Ruiz', 'use_email' => 'alberto@test.com', 'use_password' => Hash::make('12345678'), 'use_telefono' => 8774252832, 'use_role' => 1],
            ['use_nombre' => 'Bautista', 'use_app' => 'Martínez', 'use_apm' => 'Torres', 'use_email' => 'bautista@test.com', 'use_password' => Hash::make('12345678'), 'use_telefono' => 7222106061, 'use_role' => 1],
            ['use_nombre' => 'Biel', 'use_app' => 'Pérez', 'use_apm' => 'Ramírez', 'use_email' => 'biel@test.com', 'use_password' => Hash::make('12345678'), 'use_telefono' => 9222258846, 'use_role' => 1],
            ['use_nombre' => 'Bruno', 'use_app' => 'García', 'use_apm' => 'Flores', 'use_email' => 'bruno@test.com', 'use_password' => Hash::make('12345678'), 'use_telefono' => 7223173200, 'use_role' => 1],
            ['use_nombre' => 'Carlos', 'use_app' => 'Sánchez', 'use_apm' => 'Benítez', 'use_email' => 'carlos@test.com', 'use_password' => Hash::make('12345678'), 'use_telefono' => 2383820996, 'use_role' => 1],
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
