<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecensioneTable extends Migration {

	public function up()
	{
		Schema::create('recensione', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('recensable_id');
			$table->string('recensable_type', 60);
			$table->timestamps();
			$table->tinyInteger('rate');
			$table->text('commento');
			$table->integer('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('recensione');
	}
}