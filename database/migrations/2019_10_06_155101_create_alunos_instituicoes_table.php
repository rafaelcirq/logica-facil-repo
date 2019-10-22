<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosInstituicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos_instituicoes', function (Blueprint $table) {
            $table->integer('alunos_id')->unsigned();
            $table->foreign('alunos_id')
            ->references('id')
            ->on('alunos')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->integer('instituicoes_id')->unsigned();
            $table->foreign('instituicoes_id')
            ->references('id')
            ->on('instituicoes')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->primary(['alunos_id','instituicoes_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos_instituicoes');
    }
}
