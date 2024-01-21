<?php

/**
 * @apiGroup           InquiryQuotation
 * @apiName            GetAllInquiryQuotations
 *
 * @api                {GET} /v1/inquiry-quotations Get All Inquiry Quotations
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

Route::get('getallinquiryquotations', [Controller::class, 'getAllInquiryQuotations'])
    ->middleware(['auth:tenant']);
