<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDisputacampsTable.
 */
class CreateDisputacampsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('disputacamps', function(Blueprint $table) {
			$table->id();
			$table->foreignId('campeonato_id')->references('id')->on('campeonatos');
			$table->integer('player1');
			$table->integer('player2');
            $table->integer('golplay1')->nullable();
            $table->integer('golplay2')->nullable();
			$table->date('data');
			$table->time('hora');
			$table->integer('vencedor')->nullable();
			$table->string('url_video')->nullable();
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
		Schema::drop('disputacamps');
	}
}
