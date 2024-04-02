<?php

namespace App\Containers\AppSection\InquiryQuotation\Actions;

use App\Containers\AppSection\InquiryQuotation\Tasks\DeleteInquiryQuotationTask;
use App\Containers\AppSection\InquiryQuotation\UI\API\Requests\DeleteInquiryQuotationRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteInquiryQuotationAction extends ParentAction
{

    public function run(DeleteInquiryQuotationRequest $request, $InputData)
    {
        return app(DeleteInquiryQuotationTask::class)->run($InputData);
    }
}
