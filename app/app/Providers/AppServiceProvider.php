<?php

namespace App\Providers;

use App\Domain\Repositories\Contracts\PokemonRepositoryInterface;
use App\Repositories\PokemonRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PokemonRepositoryInterface::class, PokemonRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
