<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMovimentosTable.
 */
class CreateMovimentosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movimentos', function(Blueprint $table) {
            $table->increments('id');
			$table->string('description');
            $table->enum('tipo', ['credito','debito']);
            $table->decimal('valor', 9, 2);
            $table->dateTime('data');
            $table->string('data_unix');
            $table->string('meio_pag');
            $table->string('operation_key')->unique();
            $table->string('status')->default("Bloqueado");
            $table->string('motiv_status')->nullable();
            $table->foreignId('conta_id')->references('id')->on('contas');
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
		Schema::drop('movimentos');
	}
}
