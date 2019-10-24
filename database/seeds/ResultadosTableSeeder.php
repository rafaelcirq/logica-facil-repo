<?php

use Illuminate\Database\Seeder;

class ResultadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resultados = factory(\App\Entities\Resultados::class, 50)->create();

        App\Entities\Alternativas::All()->each(function ($alternativa) use ($resultados) {
            $alternativa->resultados()->attach($resultados, ['is_escolhida' => true]);
        });
    }
}
