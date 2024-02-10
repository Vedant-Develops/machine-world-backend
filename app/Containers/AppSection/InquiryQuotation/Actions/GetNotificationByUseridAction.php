<?php

namespace App\Containers\AppSection\InquiryQuotation\Actions;

use App\Containers\AppSection\InquiryQuotation\Models\InquiryQuotation;
use App\Containers\AppSection\InquiryQuotation\Tasks\GetNotificationByUseridTask;
use App\Containers\AppSection\InquiryQuotation\UI\API\Requests\FindInquiryQuotationByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class GetNotificationByUseridAction extends ParentAction
{

    public function run(FindInquiryQuotationByIdRequest $request)
    {

        return app(GetNotificationByUseridTask::class)->run($request->id);
    }
}
