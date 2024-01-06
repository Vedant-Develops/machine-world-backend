<?php

/**
 * @apiGroup           Tenantusers
 * @apiName            DeleteTenantusers
 *
 * @api                {DELETE} /v1/tenantusers/:id Delete Tenantusers
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

Route::get('deletetenantusers/{id}', [Controller::class, 'deleteTenantusers'])
  ->middleware(['auth:tenant']);
