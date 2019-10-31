<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController')->only('store');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/var', function () {
        return view('var.var');
    });

    Route::resource('alternativas', 'AlternativasController');

    Route::resource('alunos', 'AlunosController');

    Route::resource('minhas-instituicoes', 'InstituicoesController');
    Route::get('minhas-instituicoes/universidades/{uf}/{municipio}', "InstituicoesController@getUniversidades");
    Route::get('minhas-instituicoes/escolas/{uf}/{municipio}', "InstituicoesController@getEscolas");
    Route::get('minhas-instituicoes/is-instituicao-associada-ao-usuario/{instituicao}', "InstituicoesController@isInstituicaoAssociadaAoUsuario");

    Route::resource('perguntas', 'PerguntasController');

    Route::resource('professores', 'ProfessoresController');

    Route::resource('testes', 'TestesController');

    Route::resource('users', 'UsersController')->except('store');
    Route::post('password', 'UsersController@password')->name('users.password');

    Route::resource('turmas', 'TurmasController');
    Route::get('turmas/{id}/alunos', "TurmasController@getAlunos");

});
