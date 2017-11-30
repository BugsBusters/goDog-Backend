<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('cognome', 20)->nullable();
            $table->string('fotopath', 300)->nullable();
            $table->date('datanascita')->nullable();
            $table->integer('plan')->default('0')->default(0);
        });
    }

    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('name');
            $table->dropColumn('cognome');

            $table->dropColumn('datanascita');
            $table->dropColumn('plan');
        });
    }
}
