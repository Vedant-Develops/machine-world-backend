<?php

/**
 * @apiGroup           Countrymaster
 * @apiName            UpdateCountrymaster
 *
 * @api                {PATCH} /v1/countrymasters/:id Update Countrymaster
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

Route::post('updatecountrymasters/{id}', [Controller::class, 'updateCountrymaster'])
    ->middleware(['auth:tenant']);
