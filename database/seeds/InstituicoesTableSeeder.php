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
        $instituicao = factory(\App\Entities\Instituicoes::class, 50)->create();
    }
}
