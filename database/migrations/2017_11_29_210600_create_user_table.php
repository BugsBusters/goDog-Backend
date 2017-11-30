<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropColumn('name')->default('');
			$table->string('cognome', 20)->default('');
			$table->string('fotopath', 300)->default('');
			$table->date('datanascita')->default('')->default(NULL);
			$table->integer('plan')->default('0')->default(0);
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table){
	            $table->string('name');
		    $table->dropColumn('nome');
		    $table->dropColumn('cognome');
		  
		    $table->dropColumn('datanascita');
		    $table->dropColumn('plan');
		});
        }
}
