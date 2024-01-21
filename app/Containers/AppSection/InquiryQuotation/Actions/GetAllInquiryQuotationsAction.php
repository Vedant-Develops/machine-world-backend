<?php

namespace App\Containers\AppSection\InquiryQuotation\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\InquiryQuotation\Tasks\GetAllInquiryQuotationsTask;
use App\Containers\AppSection\InquiryQuotation\UI\API\Requests\GetAllInquiryQuotationsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllInquiryQuotationsAction extends ParentAction
{

    public function run(GetAllInquiryQuotationsRequest $request)
    {
        return app(GetAllInquiryQuotationsTask::class)->run();
    }
}
