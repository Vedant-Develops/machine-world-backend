<?php

namespace App\Containers\AppSection\InquiryQuotation\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\InquiryQuotation\Data\Repositories\InquiryQuotationRepository;
use App\Containers\AppSection\InquiryQuotation\Models\ClientInquiry;
use App\Containers\AppSection\InquiryQuotation\Models\InquiryQuotation;
use App\Containers\AppSection\InquiryQuotation\Models\MwNotifications;
use App\Containers\AppSection\InquiryQuotation\Models\Quotation;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateFollowupNotificationTask extends ParentTask
{
    use HashIdTrait;
    protected InquiryQuotationRepository $repository;
    public function __construct(InquiryQuotationRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($id)
    {
        try {
            $updateData = MwNotifications::where('id', $id)->update(["is_seen" => 1]);
            $returnData = array();
            $returnData['message'] = "Notification status has been updated ";
            $returnData['object'] = "mw_notifications";
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to update the resource. Please try again later.',
                'object' => 'mw_notifications',
                'data' => [],
            ];
        }
    }
}
