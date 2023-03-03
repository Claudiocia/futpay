<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCampeonatosTable.
 */
class CreateCampeonatosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campeonatos', function(Blueprint $table) {
			$table->id();
			$table->time('hora');
			$table->date('data');
			$table->decimal('valor', 9, 2);
			$table->enum('premio', ['pg', 'npg']);
			$table->integer('qtd_players');
			$table->enum('status', ['pend', 'disput', 'finaliz']);
			$table->decimal('arrecadacao_total', 9, 2)->nullable();
			$table->integer('vencedor')->nullable();
			$table->integer('vice')->nullable();
			$table->integer('terceiro')->nullable();
			$table->integer('quarto')->nullable();
			$table->foreignId('plataforma_id')->references('id')->on('plataformas');

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
		Schema::drop('campeonatos');
	}
}
