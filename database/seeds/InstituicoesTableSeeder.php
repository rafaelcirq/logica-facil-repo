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

        App\User::All()->each(function ($user) use ($instituicoes) {
            $user->instituicoes()->attach($instituicoes);
        });
    }
}
