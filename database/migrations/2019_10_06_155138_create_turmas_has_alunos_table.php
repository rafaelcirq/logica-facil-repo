<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasHasAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas_has_alunos', function (Blueprint $table) {
            $table->integer('turmas_id')->unsigned();
            $table->foreign('turmas_id')
            ->references('id')
            ->on('turmas')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->integer('alunos_id')->unsigned();
            $table->foreign('alunos_id')
            ->references('id')
            ->on('alunos')
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
        Schema::dropIfExists('turmas_has_alunos');
    }
}