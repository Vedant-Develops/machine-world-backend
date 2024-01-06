<?php

/**
 * @apiGroup           OAuth2
 * @apiName            frontuserlogin
 * @api                {post} /v1/frontuserlogin Login (Password Grant with proxy)
 * @apiDescription     Login Users using their email and password, without client_id and client_secret.
 *
 * @apiVersion         1.0.0
 *
 * @apiParam           {String}  email user email
 * @apiParam           {String}  password user password
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK

 */
/*
$router->post('tenantuser/login', [
    'uses'  => 'Controller@tenantUserLogin',
]);
*/

use App\Containers\AppSection\Authentication\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('tenantuser/login', [Controller::class, 'tenantUserLogin']);
