<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZeusModuleAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zeus_module_access', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_group_id')->index('user_group_id');
            $table->integer('zeus_module_sub_id')->index('zeus_module_sub_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zeus_module_access');
    }
}
