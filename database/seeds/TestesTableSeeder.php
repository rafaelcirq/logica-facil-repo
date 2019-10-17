<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class TestesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $testes = factory(\App\Entities\Testes::class, 50)->create();

        App\Entities\Alunos::All()->each(function ($aluno) use ($testes){
            $aluno->testes()->saveMany([
                $testes,
                'nota' => 0,
            ]);
         });
    }
}
