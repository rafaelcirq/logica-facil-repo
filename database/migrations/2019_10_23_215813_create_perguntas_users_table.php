<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerguntasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perguntas_users', function (Blueprint $table) {

            $table->integer('alternativas_id')->unsigned();
            $table->foreign('alternativas_id')
                ->references('id')
                ->on('alternativas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('perguntas_id')->unsigned();
            $table->foreign('perguntas_id')
                ->references('id')
                ->on('perguntas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['perguntas_id', 'users_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perguntas_users');
    }
}
