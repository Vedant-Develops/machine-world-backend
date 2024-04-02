<?php

/**
 * @apiGroup           Citymaster
 * @apiName            GetAllCitymasters
 *
 * @api                {GET} /v1/citymasters Get All Citymasters
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

use App\Containers\AppSection\Citymaster\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('getallcitymastersbysearch', [Controller::class, 'GetAllCitymastersBySearch'])
    ->middleware(['auth:tenant']);
