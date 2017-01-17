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
        DB::table('t_users')->insert([
            'name'=>'Ninguno',
            ]);
        DB::table('t_users')->insert([
            'name'=>'Superadmin',
            ]);
        DB::table('t_users')->insert([
            'name'=>'Admin',
            ]);
        DB::table('t_users')->insert([
            'name'=>'Estándar',
            ]);
        DB::table('users')->insert([
            'name'=>'Luis Fonseca',
            't_users_id'=>'2',
            'email'=>'01luisfonseca@gmail.com',
            'status'=>1,
            'password'=>bcrypt('admin1234'),
            ]);
        DB::table('options')->insert([
            'name'=>'Serial',
            'value'=>substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 9),
            'desc'=>'Código serial del dispositivo donde está alojada la aplicación.',
        ]);
        DB::table('oauth_clients')->insert([
            'name'=>'LocalApp Password',
            'secret'=>'I8dVQ8umBnjfXrutVB6maAeHMbjr2nVUGRmNjGOn',
            'redirect'=>'http://localhost',
            'personal_access_client'=>0,
            'password_client'=>100,
            'revoked'=>0
        ]);
        DB::table('estado')->insert([
            'name'=>'No en Casa',
        ]);
        DB::table('estado')->insert([
            'name'=>'Atendió',
        ]);

        Model::reguard();
    }
}
