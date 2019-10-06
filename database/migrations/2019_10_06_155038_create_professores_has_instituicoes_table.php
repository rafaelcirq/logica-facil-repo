<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessoresHasInstituicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professores_has_instituicoes', function (Blueprint $table) {
            $table->integer('professores_id')->unsigned();
            $table->foreign('professores_id')
            ->references('id')
            ->on('professores')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->integer('instituicoes_id')->unsigned();
            $table->foreign('instituicoes_id')
            ->references('id')
            ->on('instituicoes')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professores_has_instituicoes');
    }
}
