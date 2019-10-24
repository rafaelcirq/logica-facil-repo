<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituicoesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicoes_users', function (Blueprint $table) {
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('instituicoes_id')->unsigned();
            $table->foreign('instituicoes_id')
                ->references('id')
                ->on('instituicoes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['users_id', 'instituicoes_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instituicoes_users');
    }
}
