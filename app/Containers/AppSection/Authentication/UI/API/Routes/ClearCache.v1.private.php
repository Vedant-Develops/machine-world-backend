<?php

/**
 * @apiGroup           Authentication
 *
 * @apiName            Clear Cache
 *
 * @api                {GET} Clear Cache
 *
 *
 * {}
 */

use App\Containers\AppSection\Authentication\UI\API\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Route;

    Route::get('clearcache',function(){
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        return "Cache cleared successfully.";
    });
    

