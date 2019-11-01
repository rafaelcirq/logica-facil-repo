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
    Route::get('minhas-instituicoes/{id}/alunos', "InstituicoesController@getAlunos");

    Route::resource('perguntas', 'PerguntasController');

    Route::resource('professores', 'ProfessoresController');

    Route::resource('testes', 'TestesController');
    Route::get('testes/{idTurma}/create-by-turma', 'TestesController@createByTurma')->name('testes.create-by-turma');
    Route::get('testes/{idTurma}/edit-by-turma/{idTeste}', 'TestesController@editByTurma')->name('testes.edit-by-turma');
    Route::get('testes/{id}/responder', 'TestesController@responder')->name('testes.responder');
    Route::get('testes/{aluno_id}/aluno/', 'TestesController@getResultadosAluno');

    Route::resource('users', 'UsersController')->except('store');
    Route::post('password', 'UsersController@password')->name('users.password');

    Route::resource('turmas', 'TurmasController');
    Route::get('turmas/{id}/alunos', 'TurmasController@getAlunos');
    Route::get('turmas/{id}/testes', 'TurmasController@getTestes');

    Route::resource('resultados', 'ResultadosController');

});
