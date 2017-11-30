<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInserzioneTable extends Migration {

	public function up()
	{
		Schema::create('inserzione', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			//$table->string('inserzionable_type', 30);
			$table->integer('user_id');
			$table->text('contenuto');
			$table->integer('indirizzo_id')->unsigned();
			$table->integer('tipoinserzione_id')->unsigned();
            $table->string('fotopath', 300);
		});
	}

	public function down()
	{
		Schema::drop('inserzione');
	}
}