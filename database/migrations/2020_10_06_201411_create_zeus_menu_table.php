<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZeusMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zeus_menu', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('menu_code', 50)->index('menu_code');
            $table->string('title', 50);
            $table->string('segment', 50);
            $table->string('icon', 50);
            $table->integer('zeus_menu_id')->nullable()->index('zeus_menu_id');
            $table->string('route_name', 50)->nullable();
            $table->string('route_prefix_json', 50)->nullable();
            $table->integer('precedence')->default(0);
            $table->boolean('can_edit')->default(1);
            $table->boolean('can_delete')->default(1);
            $table->boolean('is_admin')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
        Schema::dropIfExists('zeus_menu');
    }
}
