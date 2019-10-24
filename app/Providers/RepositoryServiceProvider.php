<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\AlternativasRepository::class, \App\Repositories\AlternativasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AlunosRepository::class, \App\Repositories\AlunosRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstituicoesRepository::class, \App\Repositories\InstituicoesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PerguntasRepository::class, \App\Repositories\PerguntasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProfessoresRepository::class, \App\Repositories\ProfessoresRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TestesRepository::class, \App\Repositories\TestesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TurmasRepository::class, \App\Repositories\TurmasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TurmasRepository::class, \App\Repositories\TurmasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstituicoesRepository::class, \App\Repositories\InstituicoesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TurmasRepository::class, \App\Repositories\TurmasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ResultadosRepository::class, \App\Repositories\ResultadosRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AlternativasRepository::class, \App\Repositories\AlternativasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PerguntasRepository::class, \App\Repositories\PerguntasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TestesRepository::class, \App\Repositories\TestesRepositoryEloquent::class);
        //:end-bindings:
    }
}
