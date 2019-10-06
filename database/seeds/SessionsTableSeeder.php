<?php

use Illuminate\Database\Seeder;

class SessoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teste = factory(\App\Entities\Sessions::class, 1000)->create();
    }
}
