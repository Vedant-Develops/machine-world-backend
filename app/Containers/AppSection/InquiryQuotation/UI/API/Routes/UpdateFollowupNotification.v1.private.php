<?php

/**
 * @apiGroup           InquiryQuotation
 * @apiName            UpdateInquiryQuotation
 *
 * @api                {PATCH} /v1/inquiry-quotations/:id Update Inquiry Quotation
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

use App\Containers\AppSection\InquiryQuotation\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('updatefollowupnotification/{id}', [Controller::class, 'updateFollowupNotification'])
    ->middleware(['auth:tenant']);
