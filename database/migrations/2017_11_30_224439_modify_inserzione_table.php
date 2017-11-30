<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ModifyInserzioneTable extends Migration {

    public function up()
    {
        Schema::table('inserzione', function(Blueprint $table) {
            $table->dropColumn('tipoinserzione_id');
            $table->string('tipoinserzione');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inserzione');
    }
}