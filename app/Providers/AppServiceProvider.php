<?php

namespace App\Providers;

use App\Interfaces\AutorizaAlteracaoRepositoryInterface;
use App\Interfaces\PontoRepositoryInterface;
use App\Interfaces\PontoServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserServiceInterface;
use App\Services\UserService;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\AutorizaAlteracaoRepository;
use App\Repositories\PontoRepository;
use App\Repositories\UserRepository;
use App\Services\AutorizaAlteracaoService;
use App\Services\PontoService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PontoServiceInterface::class, PontoService::class);
        $this->app->bind(PontoRepositoryInterface::class, PontoRepository::class);
        $this->app->bind(AutorizaAlteracaoRepositoryInterface::class, AutorizaAlteracaoRepository::class);
        $this->app->bind(AutorizaAlteracaoService::class, AutorizaAlteracaoService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
