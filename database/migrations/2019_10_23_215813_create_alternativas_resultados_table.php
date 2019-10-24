<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternativasResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternativas_resultados', function (Blueprint $table) {
            $table->integer('alternativas_id')->unsigned();
            $table->foreign('alternativas_id')
                ->references('id')
                ->on('alternativas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('resultados_id')->unsigned();
            $table->foreign('resultados_id')
                ->references('id')
                ->on('resultados')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->boolean('is_escolhida');

            $table->primary(['alternativas_id', 'resultados_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alternativas_resultados');
    }
}
