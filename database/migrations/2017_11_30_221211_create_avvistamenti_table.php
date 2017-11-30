<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvvistamentiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avvistamenti', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('foto')->nullable;
            $table->integer('user_id');
            $table->text('commento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avvistamenti');
    }
}
