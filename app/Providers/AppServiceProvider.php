<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Gate::define('admin', function(User $user){
            return $user->role === 'Admin';
        });

        Gate::define('petugas_pendaftaran', function(User $user){
            return $user->role === 'Petugas Pendaftaran';
        });

        Gate::define('dokter', function(User $user){
            return $user->role === 'Dokter';
        });

        Gate::define('kasir', function(User $user){
            return $user->role === 'Kasir';
        });
    }
}
