<?php

/**
 * @apiGroup           Statemaster
 * @apiName            FindStatemasterById
 *
 * @api                {GET} /v1/statemasters/:id Find Statemaster By Id
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

use App\Containers\AppSection\Statemaster\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('getstatemastersbyid/{id}', [Controller::class, 'findStatemasterById'])
    ->middleware(['auth:tenant']);
