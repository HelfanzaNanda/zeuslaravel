<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZeusUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zeus_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username', 30)->index('username');
            $table->string('email', 50)->index('email');
            $table->string('password');
            $table->integer('user_group_id')->index('user_group_id');
            $table->string('token')->nullable();
            $table->boolean('status')->default(0);
            $table->string('avatar', 100)->nullable();
            $table->dateTime('last_login')->nullable();
            $table->string('forgot_token', 50)->nullable();
            $table->timestamp('forgot_valid')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
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
        Schema::dropIfExists('zeus_user');
    }
}
