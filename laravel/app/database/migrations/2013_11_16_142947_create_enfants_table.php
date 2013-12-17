<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnfantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enfants', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nom', 30);
			$table->string('prenom', 30);
			$table->date('datenaissance');
			$table->string('sexe', 4);
			$table->integer('numcontrat');
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
		Schema::drop('enfants');
	}

}
