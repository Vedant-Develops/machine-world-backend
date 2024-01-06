<?php

/**
 * @apiGroup           Role
 * @apiName            GetAllRoles
 *
 * @api                {GET} /v1/roles Get All Roles
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

use App\Containers\AppSection\Role\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('getallroles', [Controller::class, 'getAllRoles'])
    ->middleware(['auth:tenant']);
