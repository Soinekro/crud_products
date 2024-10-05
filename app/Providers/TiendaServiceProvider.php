<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Src\Tienda\Domain\Repositories\ProductRepositoryInterface;
use Src\Tienda\Infraestructure\Http\ProductLivewire;
use Src\Tienda\Infraestructure\Repositories\ProductRepository;

class TiendaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Livewire::component('product-livewire', ProductLivewire::class);
    }
}
