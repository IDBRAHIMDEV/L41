<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConjointsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conjoints', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nom', 30);
			$table->string('prenom', 30);
			$table->date('datenaissance');
			$table->string('sexe', 4);
			$table->string('regime', 3);
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
		Schema::drop('conjoints');
	}

}
