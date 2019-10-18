<?php

use Faker\Factory as Faker;
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
        $faker = Faker::create();

        $teste = factory(\App\Entities\Testes::class, 50)->create();

        // factory(\App\Entities\Testes::class, 50, $teste)->afterCreating();
        $i = 1;
        App\Entities\Alunos::All()->each(function ($aluno) use ($teste, $faker, $i){
            // $aluno->testes()->attach($faker->numberBetween($min = 1, $max = 50), ['nota' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10)]);
            $aluno->testes()->attach($i++, ['nota' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10)]);
        });
    }
}
