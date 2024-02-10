<?php

/**
 * @apiGroup           UserActivity
 * @apiName            UpdateUserActivity
 *
 * @api                {PATCH} /v1/user-activities/:id Update User Activity
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

use App\Containers\AppSection\UserActivity\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('user-activities/{id}', [Controller::class, 'updateUserActivity'])
    ->middleware(['auth:api']);

