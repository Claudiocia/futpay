<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRachaosTable.
 */
class CreateRachaosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rachaos', function(Blueprint $table) {
            $table->id();
			$table->enum('premio', ['pg', 'npg'])->default('npg');
			$table->time('hora');
			$table->decimal('arrecadacao_total', 9, 2);
			$table->date('data');
			$table->foreignId('plataforma_id')->references('id')->on('plataformas');
			$table->integer('qtd_players');
			$table->enum('status', ['pend', 'disput', 'finaliz']);
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
		Schema::drop('rachaos');
	}
}
