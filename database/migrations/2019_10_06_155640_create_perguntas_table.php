<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perguntas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('testes_id')->unsigned();
            $table->foreign('testes_id')
                ->references('id')
                ->on('testes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->decimal('valor', 4, 2);
            $table->longText('texto');

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
        Schema::dropIfExists('perguntas');
    }
}
