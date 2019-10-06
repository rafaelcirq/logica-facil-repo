<?php

use Illuminate\Database\Seeder;

class PerguntasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pergunta = factory(\App\Entities\Perguntas::class, 50)->create();
    }
}
