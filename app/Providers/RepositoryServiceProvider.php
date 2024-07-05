<?php

namespace App\Providers;

use App\Interfaces\DocumentRepositoryInterface;
use App\Repositories\DocumentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DocumentRepositoryInterface::class, DocumentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
