<?php
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(App\Entities\Alternativas::class, function (Faker $faker) {
    return [
        'perguntas_id' => $faker->numberBetween($min = 1, $max = 50),
        'texto' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'correta' => $faker->numberBetween($min = 0, $max = 1)
    ];
});

$factory->define(App\Entities\Alunos::class, function (Faker $faker) {
    return [
        'users_id' => $faker->numberBetween($min = 1, $max = 50),
        // 'nome' => $faker->name()
    ];
});

$factory->define(App\Entities\Instituicoes::class, function (Faker $faker) {
    return [
        'nome' => $faker->company()
    ];
});

$factory->define(App\Entities\Perguntas::class, function (Faker $faker) {
    return [
        'testes_id' => $faker->numberBetween($min = 1, $max = 50),
        'pontuacao' => $faker->numberBetween($min = 1, $max = 10),
        'texto' => $faker->sentence($nbWords = 10, $variableNbWords = true)
    ];
});

$factory->define(App\Entities\Professores::class, function (Faker $faker) {
    return [
        'users_id' => $faker->numberBetween($min = 51, $max = 100),
        // 'nome' => $faker->name()
    ];
});

$factory->define(App\Entities\Sessions::class, function (Faker $faker) {
    return [
        'alunos_id' => $faker->numberBetween($min = 1, $max = 50),
        'horario_login' => $faker->dateTimeBetween($startDate = '-3 months', $endDate = '-2 months', $timezone = null),
        'horario_logout' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
        'numero_de_cliques' => $faker->numberBetween($min = 1, $max = 300),
        'tempo_na_var' => $faker->time($format = 'H:i:s', $max = 'now'),
        'payload' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'last_activity' => $faker->numberBetween($min = 1, $max = 300)
    ];
});

$factory->define(App\Entities\Testes::class, function (Faker $faker) {
    return [
        'turmas_id' => $faker->numberBetween($min = 1, $max = 50),
        'valor' => 10.00
    ];
});

$factory->define(App\Entities\Turmas::class, function (Faker $faker) {
    return [
        'instituicoes_id' => $faker->numberBetween($min = 1, $max = 50),
        'professores_id' => $faker->numberBetween($min = 1, $max = 50),
        'nome' => $faker->word()
    ];
});

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'email' => $faker->freeEmail(),
        'password' => Hash::make('12345678'),
        'tipo' => $faker->randomElement($array = array ('Aluno','Professor'))
    ];
});