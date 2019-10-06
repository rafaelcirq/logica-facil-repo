<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('instituicoes_id')->unsigned();
            $table->foreign('instituicoes_id')
            ->references('id')
            ->on('instituicoes')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->integer('professores_id')->unsigned();
            $table->foreign('professores_id')
            ->references('id')
            ->on('professores')
            ->onUpdate('cascade')
			->onDelete('cascade');
			
			$table->string('nome');

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
        Schema::dropIfExists('turmas');
    }
}
