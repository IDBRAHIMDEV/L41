<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocsmotifsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('docsmotifs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('motif_id')->references('id')->on('motifsdemandes');
			$table->integer('doc_id')->references('id')->on('docs');
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
		Schema::drop('docsmotifs');
	}

}
