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

        App\Entities\Alunos::All()->each(function ($aluno) use ($turmas){
            $aluno->turmas()->saveMany($turmas);
         });
    }
}
