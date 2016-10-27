<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersTableCampo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('api_token', 60)->unique();
            $table->string('lastname');
            $table->biginteger('identificacion');
            $table->date('birday');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('acudiente');
            $table->string('tipo_sangre');
            $table->string('tarjeta');
            $table->integer('tipo_usuario_id');
            $table->softDeletes();
            $table->integer('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('api_token', 60)->unique();
            $table->string('lastname');
            $table->biginteger('identificacion');
            $table->date('birday');
            $table->string('email');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('acudiente');
            $table->string('tipo_sangre');
            $table->integer('tipo_usuario_id');
            $table->softDeletes();
            $table->integer('estado');
        });
    }
}
