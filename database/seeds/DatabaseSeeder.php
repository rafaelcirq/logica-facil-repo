<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        $this->call(ProfessoresTableSeeder::class);

        $this->call(AlunosTableSeeder::class);

        // $this->call(SessionsTableSeeder::class);

        $this->call(InstituicoesTableSeeder::class);

        $this->call(TurmasTableSeeder::class);

        $this->call(TestesTableSeeder::class);

        $this->call(PerguntasTableSeeder::class);

        $this->call(AlternativasTableSeeder::class);
    }
}
