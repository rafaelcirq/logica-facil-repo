<?php

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
        $teste = factory(\App\Entities\Testes::class, 50)->create();
    }
}
