<?php

use Illuminate\Database\Seeder;

class AlternativasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alternativa = factory(\App\Entities\Alternativas::class, 200)->create();
    }
}
