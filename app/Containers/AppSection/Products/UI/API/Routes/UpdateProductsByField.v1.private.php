<?php

/**
 * @apiGroup           Products
 * @apiName            UpdateProducts
 *
 * @api                {PATCH} /v1/products/:id Update Products
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

Route::post('updateproductsbyfield/{id}', [Controller::class, 'UpdateProductsByField'])
    ->middleware(['auth:tenant']);
