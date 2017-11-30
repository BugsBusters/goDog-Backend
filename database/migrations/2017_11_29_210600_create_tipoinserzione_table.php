<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoinserzioneTable extends Migration {

	public function up()
	{
		Schema::create('tipoinserzione', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('tipo', 20);
		});
	}

	public function down()
	{
		Schema::drop('tipoinserzione');
	}
}