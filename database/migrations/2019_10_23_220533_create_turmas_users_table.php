<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas_users', function (Blueprint $table) {
            $table->integer('turmas_id')->unsigned();
            $table->foreign('turmas_id')
                ->references('id')
                ->on('turmas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['users_id', 'turmas_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turmas_users');
    }
}
