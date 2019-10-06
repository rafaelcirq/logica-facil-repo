<?php

use Illuminate\Database\Seeder;

class AlunosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // https://stackoverflow.com/questions/45269146/laravel-seeding-many-to-many-relationship
        // $instituicoes = App\Entities\Instituicoes::all();

        $aluno = factory(\App\Entities\Alunos::class, 50)->create();
        // $aluno->instituicoes()->sync(
            // $instituicoes->random(rand(1, 1))->pluck('id')->toArray()
        // ); 
    }
}
