<?php

/**
 * @apiGroup           Tenantusers
 * @apiName            UpdateTenantusers
 *
 * @api                {PATCH} /v1/tenantusers/:id Update Tenantusers
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

use App\Containers\AppSection\Tenantusers\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('updatetenantusersbyfields/{id}', [Controller::class, 'UpdateTenantusersByFields'])
   ->middleware(['auth:tenant']);