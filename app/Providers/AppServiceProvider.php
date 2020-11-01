<?php

namespace App\Providers;

use App\Models\Animal;
use App\Repositories\Eloquent\AnimalRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Contracts\AnimalRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        
        $this->app->when(AnimalRepository::class)->needs(Animal::class)->give(function() {
            $route = request()->route();
            if($route && $route->hasParameter('animal')) {
                if($route->parameter('animal')) {
                    return Animal::findOrFail($route->parameter('animal'));
                }
                
                return null;
            }

            // throw new ModelNotFoundException('Animal not found');
        });

        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
