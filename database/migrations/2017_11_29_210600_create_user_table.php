<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropColumn('name');			
			$table->string('nome', 20);
			$table->string('cognome', 20);
			$table->string('fotopath', 300);
			$table->date('datanascita');
			$table->integer('plan')->default('0');
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
