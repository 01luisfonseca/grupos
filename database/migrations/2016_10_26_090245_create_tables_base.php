<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('t_users')) {
        Schema::create('t_users', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
        }
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('value',100);
            $table->mediumText('desc')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_users');
        Schema::dropIfExists('options');
    }
}
