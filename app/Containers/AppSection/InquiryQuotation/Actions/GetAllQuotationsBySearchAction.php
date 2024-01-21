<?php

namespace App\Containers\AppSection\InquiryQuotation\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\InquiryQuotation\Tasks\GetAllQuotationsBySearchTask;
use App\Containers\AppSection\InquiryQuotation\UI\API\Requests\GetAllInquiryQuotationsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllQuotationsBySearchAction extends ParentAction
{

    public function run(GetAllInquiryQuotationsRequest $request, $InputData)
    {
        return app(GetAllQuotationsBySearchTask::class)->run($InputData);
    }
}
