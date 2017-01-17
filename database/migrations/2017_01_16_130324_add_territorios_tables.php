<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTerritoriosTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->string('name');
            $table->mediumText('desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('territorio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grupo_id')->unsigned();
            $table->string('name');
            $table->mediumText('desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('territorio_has_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->integer('territorio_id')->unsigned();
            $table->dateTime('finished')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('cuadra', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('territorio_id')->unsigned();
            $table->string('name');
            $table->mediumText('desc')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
        Schema::create('ubicacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuadra_id')->unsigned();
            $table->string('type');
            $table->string('number');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('casa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuadra_id')->unsigned();
            $table->string('type');
            $table->string('number');
            $table->string('frontnumber');
            $table->string('homenumber');
            $table->mediumText('desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('estado_casa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('casa_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->mediumText('desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('estado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
        // Relations
        Schema::table('territorio', function (Blueprint $table) {
            $table->foreign('grupo_id')->references('id')->on('grupo')->onDelete('cascade');
        });
        Schema::table('territorio_has_users', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('territorio_id')->references('id')->on('territorio')->onDelete('cascade');
        });
        Schema::table('cuadra', function (Blueprint $table) {
            $table->foreign('territorio_id')->references('id')->on('territorio')->onDelete('cascade');
        });
        Schema::table('ubicacion', function (Blueprint $table) {
            $table->foreign('cuadra_id')->references('id')->on('cuadra')->onDelete('cascade');
        });
        Schema::table('casa', function (Blueprint $table) {
            $table->foreign('cuadra_id')->references('id')->on('cuadra')->onDelete('cascade');
        });
        Schema::table('estado_casa', function (Blueprint $table) {
            $table->foreign('casa_id')->references('id')->on('casa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo');
        Schema::dropIfExists('territorio');
        Schema::dropIfExists('territorio_has_users');
        Schema::dropIfExists('cuadra');
        Schema::dropIfExists('ubicacion');
        Schema::dropIfExists('casa');
        Schema::dropIfExists('estado_casa');
        Schema::dropIfExists('estado');
    }
}
