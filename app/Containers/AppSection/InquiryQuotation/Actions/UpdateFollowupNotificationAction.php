<?php

namespace App\Containers\AppSection\InquiryQuotation\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\InquiryQuotation\Tasks\UpdateFollowupNotificationTask;
use App\Containers\AppSection\InquiryQuotation\UI\API\Requests\UpdateInquiryQuotationRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Auth;

class UpdateFollowupNotificationAction extends ParentAction
{

    public function run(UpdateInquiryQuotationRequest $request)
    {

        return app(UpdateFollowupNotificationTask::class)->run($request->id);
    }
}
