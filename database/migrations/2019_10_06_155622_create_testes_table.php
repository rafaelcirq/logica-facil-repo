<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('alunos_id')->unsigned();
            $table->foreign('alunos_id')
            ->references('id')
            ->on('alunos')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->integer('turmas_id')->unsigned();
            $table->foreign('turmas_id')
            ->references('id')
            ->on('turmas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->decimal('valor', 4, 2);

            $table->decimal('nota', 4, 2);

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
        Schema::dropIfExists('testes');
    }
}
