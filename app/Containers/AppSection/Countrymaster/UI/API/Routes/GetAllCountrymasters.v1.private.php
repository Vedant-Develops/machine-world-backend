<?php

/**
 * @apiGroup           Countrymaster
 * @apiName            GetAllCountrymasters
 *
 * @api                {GET} /v1/countrymasters Get All Countrymasters
 * @apiDescription     Endpoint description here...
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} parameters here...
 *
 * @apiSuccessExample  {json} Success-Response:
 * HTTP/1.1 200 OK
 * {
 *     // Insert the response of the request here...
 * }
 */

use App\Containers\AppSection\Countrymaster\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('getallcountrymasters', [Controller::class, 'getAllCountrymasters'])
    ->middleware(['auth:tenant']);

