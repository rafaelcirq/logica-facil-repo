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
        $testes = factory(\App\Entities\Testes::class, 50)->create();   
    }
}
