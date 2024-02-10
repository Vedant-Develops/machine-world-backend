<?php

namespace App\Containers\AppSection\InquiryQuotation\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\InquiryQuotation\Data\Repositories\InquiryQuotationRepository;
use App\Containers\AppSection\InquiryQuotation\Models\ClientInquiry;
use App\Containers\AppSection\InquiryQuotation\Models\InquiryQuotation;
use App\Containers\AppSection\InquiryQuotation\Models\MwNotifications;
use App\Containers\AppSection\InquiryQuotation\Models\Quotation;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class GetNotificationByUseridTask extends ParentTask
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

            $returnData = [];
            $getData = MwNotifications::where('user_to_notify', $id)->where('is_seen', 0)->orderBy('created_at', 'DESC')->get();


            if (!empty($getData) &&  count($getData) >= 1) {
                $returnData['message'] = "Data found";
                for ($i = 0; $i < count($getData); $i++) {
                    $returnData['data'][$i]['object'] = "mw_notifications";
                    $returnData['data'][$i]['id'] = $this->encode($getData[$i]->id);
                    $returnData['data'][$i]['user_to_notify'] = $this->encode($getData[$i]->user_to_notify);
                    $returnData['data'][$i]['user_who_fired_event'] =  $this->encode($getData[$i]->user_who_fired_event);
                    $returnData['data'][$i]['message'] = $getData[$i]->message;
                    $returnData['data'][$i]['is_seen'] = $getData[$i]->is_seen;
                    $returnData['data'][$i]['module'] = $getData[$i]->module;
                    $returnData['data'][$i]['created_at'] = $getData[$i]->created_at;
                    $returnData['data'][$i]['updated_at'] = $getData[$i]->updated_at;
                }
            } else {
                $returnData = [
                    'message' => 'Error: Data not found.',
                    'object' => 'mw_notifications',
                    'data' => [],
                ];
            }
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to find the resource. Please try again later.',
                'object' => 'mw_notifications',
                'data' => [],
            ];
        }
    }
}
