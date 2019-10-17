<?php

use Illuminate\Database\Seeder;

class InstituicoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instituicoes = factory(\App\Entities\Instituicoes::class, 50)->create();

        App\Entities\Professores::All()->each(function ($professor) use ($instituicoes){
            $professor->instituicoes()->saveMany($instituicoes);
         });

         App\Entities\Alunos::All()->each(function ($aluno) use ($instituicoes){
            $aluno->instituicoes()->saveMany($instituicoes);
         });
    }
}
