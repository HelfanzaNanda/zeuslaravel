<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZeusMenuGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zeus_menu_group', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('zeus_menu_id')->index('zeus_menu_id');
            $table->integer('user_group_id')->index('user_group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zeus_menu_group');
    }
}
