<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContratattributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contratattributes', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('contrat_id')->references('id')->on('contrat');
			$table->integer('attribute_id')->references('id')->on('attribute');
			$table->string('valeur');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contratattributes');
	}

}
