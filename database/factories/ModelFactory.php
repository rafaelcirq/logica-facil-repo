<?php
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(App\Entities\Alternativas::class, function (Faker $faker) {
    return [
        'perguntas_id' => $faker->numberBetween($min = 1, $max = 50),
        'texto' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'is_correta' => $faker->numberBetween($min = 0, $max = 1)
    ];
});

$factory->define(App\Entities\Instituicoes::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\pt_BR\Company($faker));
    return [
        'nome' => $faker->company(),
        'sigla' => $faker->stateAbbr(),
        'cnpj' => $faker->cnpj(false)
    ];
});

$factory->define(App\Entities\Perguntas::class, function (Faker $faker) {
    return [
        'testes_id' => $faker->numberBetween($min = 1, $max = 50),
        'valor' => $faker->numberBetween($min = 0, $max = 10),
        'texto' => $faker->sentence($nbWords = 10, $variableNbWords = true)
    ];
});

$factory->define(App\Entities\Resultados::class, function (Faker $faker) {
    return [
        'testes_id' => $faker->numberBetween($min = 1, $max = 50),
        'users_id' => $faker->numberBetween($min = 1, $max = 50),
        'nota' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10)
    ];
});

$factory->define(App\Entities\Testes::class, function (Faker $faker) {
    return [
        'turmas_id' => $faker->numberBetween($min = 1, $max = 50),
        'nome' => $faker->word(),
        'data_inicio' => $faker->dateTimeBetween($startDate = '-3 months', $endDate = '-2 months', $timezone = null),
        'data_limite' => $faker->dateTimeThisMonth($max = 'now', $timezone = null),
        'valor' => 10.00,
    ];
});

$factory->define(App\Entities\Turmas::class, function (Faker $faker) {
    return [
        'instituicoes_id' => $faker->numberBetween($min = 1, $max = 50),
        'nome' => $faker->word(),
        'users_id' => $faker->numberBetween($min = 1, $max = 50),
    ];
});

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'email' => $faker->unique()->email(),
        'password' => Hash::make('12345678'),
        'tipo' => $faker->randomElement($array = array('Aluno', 'Professor')),
    ];
});
