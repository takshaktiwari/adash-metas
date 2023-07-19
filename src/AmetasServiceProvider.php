<?php

namespace Takshak\Ametas;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AmetasServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //$this->commands([InstallCommand::class]);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ametas');
        $this->loadViewComponentsAs('ametas', [
            View\Components\Ametas\AdminSidebarLinks::class,
            View\Components\Ametas\Metatags::class,
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views'),
        ]);

        Paginator::useBootstrap();
    }

}
