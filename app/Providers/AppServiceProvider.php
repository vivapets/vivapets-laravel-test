<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Animal;
use App\Models\AnimalType;
use App\Models\AnimalBreed;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\AnimalRepository;
use App\Repositories\Eloquent\AnimalTypeRepository;
use App\Repositories\Eloquent\AnimalBreedRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\AnimalRepositoryInterface;
use App\Repositories\Contracts\AnimalTypeRepositoryInterface;
use App\Repositories\Contracts\AnimalBreedRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Animals bindings
         */

        $this->app->bind(AnimalRepositoryInterface::class, AnimalRepository::class);
        $this->app->when(AnimalRepository::class)->needs(Animal::class)->give(function() {
            $route = request()->route();
            if($route && $route->hasParameter('animal')) {
                if($route->parameter('animal')) {
                    return Animal::findOrFail($route->parameter('animal'));
                }
                
                return null;
            }
        });

        /**
         * Animals Types bindings
         */
        $this->app->bind(AnimalTypeRepositoryInterface::class, AnimalTypeRepository::class);
        $this->app->when(AnimalTypeRepository::class)->needs(AnimalType::class)->give(function() {
            $route = request()->route();
            if($route && $route->hasParameter('animals_type')) {
                if($route->parameter('animals_type')) {
                    return AnimalType::findOrFail($route->parameter('animals_type'));
                }
                
                return null;
            }
        });


        /**
         * Animals Breeds bindings
         */
        $this->app->bind(AnimalBreedRepositoryInterface::class, AnimalBreedRepository::class);
        $this->app->when(AnimalBreedRepository::class)->needs(AnimalBreed::class)->give(function() {
            $route = request()->route();
            if($route && $route->hasParameter('animals_breed')) {
                if($route->parameter('animals_breed')) {
                    return AnimalBreed::findOrFail($route->parameter('animals_breed'));
                }
                
                return null;
            }
        });

        /**
         * Users bindings
         */
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->when(UserRepository::class)->needs(User::class)->give(function() {
            $route = request()->route();
            
            if($route && $route->hasParameter('user')) {
                if($route->parameter('user')) {
                    return User::findOrFail($route->parameter('user'));
                }
                
                return null;
            }
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
