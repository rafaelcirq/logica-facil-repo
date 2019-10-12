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
    return view('auth.welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/var', function () {
        return view('var.var');
    });

    Route::resource('alternativas', 'AlternativasController');

    Route::resource('alunos', 'AlunosController');

    Route::resource('instituicoes', 'InstituicoesController');

    Route::resource('perguntas', 'PerguntasController');

    Route::resource('professores', 'ProfessoresController');

    Route::resource('testes', 'TestesController');

    Route::resource('turmas', 'TurmasController');

});
