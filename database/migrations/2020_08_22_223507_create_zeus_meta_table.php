<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZeusMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zeus_meta', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('meta_group', 40)->index('meta_group');
            $table->string('meta_key', 50)->index('option_key');
            $table->text('meta_value')->nullable();
            $table->integer('user_id')->nullable()->index('user_id');
            $table->integer('user_group_id')->nullable();
            $table->boolean('editable')->default(0);
            $table->timestamp('created_at');
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
        Schema::dropIfExists('zeus_meta');
    }
}
