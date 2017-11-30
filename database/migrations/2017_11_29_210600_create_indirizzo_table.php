<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndirizzoTable extends Migration {

	public function up()
	{
		Schema::create('indirizzo', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('indrizzable_id');
			$table->string('indirizzable_type', 50);
			$table->string('via', 50);
			$table->string('citta', 50);
			$table->string('provincia', 50);
			$table->string('regione', 30);
		});
	}

	public function down()
	{
		Schema::drop('indirizzo');
	}
}