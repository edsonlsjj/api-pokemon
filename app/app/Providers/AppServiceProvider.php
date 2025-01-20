<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Pokemon\Domain\Repositories\Contracts\PokemonRepositoryInterface;
use Modules\Pokemon\Infrastructure\Repositories\PokemonRepository;

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
