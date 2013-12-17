<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGammesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gammes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('libelle', 20);
			$table->string('code', 6);
			$table->boolean('active')->default(1);
			$table->integer('compagnie_id');
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
		Schema::drop('gammes');
	}

}
