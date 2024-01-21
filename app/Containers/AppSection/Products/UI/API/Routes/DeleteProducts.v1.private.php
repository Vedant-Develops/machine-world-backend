<?php

/**
 * @apiGroup           Products
 * @apiName            DeleteProducts
 *
 * @api                {DELETE} /v1/products/:id Delete Products
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

use App\Containers\AppSection\Products\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('deleteproducts/{id}', [Controller::class, 'deleteProducts'])
    ->middleware(['auth:tenant']);
