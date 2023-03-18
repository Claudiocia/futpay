<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateContasTable.
 */
class CreateContasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contas', function(Blueprint $table) {
            $table->id();
			$table->integer('numero')->unique();
            $table->decimal('saldo', 9, 2)->default(0.00);
            $table->enum('active', ['s', 'n'])->default('s');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contas');
	}
}
