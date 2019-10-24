<?php

use Illuminate\Database\Seeder;

class TurmasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $turmas = factory(\App\Entities\Turmas::class, 50)->create();

        App\User::Where('tipo', 'Aluno')->each(function ($user) use ($turmas) {
            $user->turmasAluno()->attach($turmas);
        });
    }
}
