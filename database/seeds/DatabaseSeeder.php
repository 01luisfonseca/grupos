<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        DB::table('tipo_usuario')->insert([
            'nombre'=>'Ninguno',
            ]);
        DB::table('tipo_usuario')->insert([
            'nombre'=>'Alumno',
            ]);
        DB::table('tipo_usuario')->insert([
            'nombre'=>'Trabajador estándar',
            ]);
        DB::table('tipo_usuario')->insert([
            'nombre'=>'Profesor',
            ]);
        DB::table('tipo_usuario')->insert([
            'nombre'=>'Coordinador',
            ]);
        DB::table('tipo_usuario')->insert([
            'nombre'=>'Administrador',
            ]);
        DB::table('users')->insert([
            'name'=>'administrador',
            'lastname'=>'admin',
            'identificacion'=>'1',
            'birday'=>'2016/10/10',
            'telefono'=>'5000000',
            'direccion'=>'no definida',
            'acudiente'=>'N-A',
            'tipo_sangre'=>'N-A',
            'tarjeta'=>'00000000',
            'estado'=>1,
            'tipo_usuario_id'=>'6',
            'email'=>'01luisfonseca@gmail.com',
            'password'=>bcrypt('admin1234'),
            'api_token'=>str_random(60),
            ]);
        DB::table('generales')->insert([
            'nombre'=>'Organización',
            'valor'=>'',
            'descripcion'=>'Nombre de la organización de la aplicación.',
        ]);
        DB::table('generales')->insert([
            'nombre'=>'Logo',
            'valor'=>'',
            'descripcion'=>'Ruta URL donde se encuentra el logo o escudo .',
        ]);
        DB::table('generales')->insert([
            'nombre'=>'Servidor principal',
            'valor'=>'',
            'descripcion'=>'Campo que solo se usa en caso de que esta aplicación dependa de un servidor maestro. Solo se llena en caso de que esta aplicación sea esclava.',
        ]);
        DB::table('generales')->insert([
            'nombre'=>'Serial',
            'valor'=>substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 9),
            'descripcion'=>'Código serial del dispositivo donde está alojada la aplicación.',
        ]);
        DB::table('mes')->insert([
            'nombre'=>'Enero',
            ]);
        DB::table('mes')->insert([
            'nombre'=>'Febrero',
            ]);
        DB::table('mes')->insert([
            'nombre'=>'Marzo',
            ]);
        DB::table('mes')->insert([
            'nombre'=>'Abril',
            ]);
        DB::table('mes')->insert([
            'nombre'=>'Mayo',
            ]);
        DB::table('mes')->insert([
            'nombre'=>'Junio',
            ]);
        DB::table('mes')->insert([
            'nombre'=>'Julio',
            ]);
        DB::table('mes')->insert([
            'nombre'=>'Agosto',
            ]);
        DB::table('mes')->insert([
            'nombre'=>'Septiembre',
            ]);
        DB::table('mes')->insert([
            'nombre'=>'Octubre',
            ]);
        DB::table('mes')->insert([
            'nombre'=>'Noviembre',
            ]);
        DB::table('mes')->insert([
            'nombre'=>'Diciembre',
            ]);

        Model::reguard();
    }
}
