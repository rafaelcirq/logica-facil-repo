<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosHasTestesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos_has_testes', function (Blueprint $table) {

            $table->integer('alunos_id')->unsigned();
            $table->foreign('alunos_id')
            ->references('id')
            ->on('alunos')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->integer('testes_id')->unsigned();
            $table->foreign('testes_id')
            ->references('id')
            ->on('testes')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->decimal('nota', 4, 2);

            $table->timestamps();
            $table->primary(['alunos_id','testes_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos_has_testes');
    }
}
