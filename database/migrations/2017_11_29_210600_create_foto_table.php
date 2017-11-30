<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFotoTable extends Migration {

	public function up()
	{
		Schema::create('foto', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('fotoable_id');
			$table->string('fotoable_type', 50);
			$table->string('path', 300);
		});
	}

	public function down()
	{
		Schema::drop('foto');
	}
}