<?php

use Takshak\Adash\Http\Middleware\ReferrerMiddleware;
use Takshak\Adash\Http\Middleware\GatesMiddleware;
use Illuminate\Support\Facades\Route;
use Takshak\Ametas\Http\Controllers\Admin\MetatagController;

Route::middleware('web')->group(function () {
    Route::middleware(['auth', GatesMiddleware::class, ReferrerMiddleware::class])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('metatags', MetatagController::class);
        });
});
