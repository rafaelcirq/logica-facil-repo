<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternativas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('perguntas_id')->unsigned();
            $table->foreign('perguntas_id')
                ->references('id')
                ->on('perguntas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->boolean('is_correta');
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
        Schema::dropIfExists('alternativas');
    }
}
