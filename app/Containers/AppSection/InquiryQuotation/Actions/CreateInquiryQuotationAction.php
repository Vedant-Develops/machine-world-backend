<?php

namespace App\Containers\AppSection\InquiryQuotation\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\InquiryQuotation\Models\ClientInquiry;
use App\Containers\AppSection\InquiryQuotation\Models\InquiryQuotation;
use App\Containers\AppSection\InquiryQuotation\Tasks\CreateInquiryQuotationTask;
use App\Containers\AppSection\InquiryQuotation\UI\API\Requests\CreateInquiryQuotationRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Auth;

class CreateInquiryQuotationAction extends ParentAction
{
    use HashIdTrait;
    public function run(CreateInquiryQuotationRequest $request, $InputData)
    {
        $getUser = Auth::user();

        $get_inquiry_type = $InputData->getInquiryType();
        $get_latest_cl_inquiry = ClientInquiry::withTrashed()->latest('id')->first();
        $count_no = 0;
        if (!empty($get_latest_cl_inquiry->id)) {
            $count_no = $get_latest_cl_inquiry->id + 1;
        } else {
            $count_no = 1;
        }
        $year = date('Y');
        $characters = 'MW-INQ-' . $year . '-';
        $charactersLength = strlen($characters);
        $count = 0;
        do {
            $inq_code = $characters . sprintf("%05d", $count_no + $count++);
        } while (ClientInquiry::where('inquiry_code', $inq_code)->exists());


        $data = $request->sanitizeInput([
            'inquiry_type' => $get_inquiry_type,
            'inquiry_code' => $inq_code,
            'client_name' => $InputData->getClientName(),
            'mobile' => $InputData->getMobile(),
            'email' => $InputData->getEmail(),
            // 'country_id' => $this->decode($InputData->getCountry()),
            // 'state_id' => $this->decode($InputData->getState()),
            // 'city_id' => $this->decode($InputData->getCity()),
            'village' => $InputData->getVillage(),
            'address' => $InputData->getAddress(),
            'company_name' => $InputData->getCompanyName(),
            'followup_date' => $InputData->getFollowupDate(),
            'existing_machines' => $InputData->getExistingMachines(),
            'remarks' => $InputData->getRemarks(),
            'delivery_time_period' => $InputData->getDeliveryTimePeriod(),
            'is_active' => 1,
            'created_by' => $getUser['id'],
            'updated_by' => $getUser['id'],
        ]);
        $data['country_id'] = $this->decode($InputData->getCountry());
        $data['state_id'] = $this->decode($InputData->getState());
        $data['city_id'] = $this->decode($InputData->getCity());
        $product = $InputData->getProducts();
        $data_quotation = [];
        if (!empty($product)) {
            for ($i = 0; $i < count($product); $i++) {
                $product_id = $this->decode($product[$i]['product_id']);

                $data_quotation[$i] = $request->sanitizeInput([
                    'inquiry_code' => $inq_code,
                    'product_name' => $product[$i]['product_name'],
                    'qty' => $product[$i]['qty'],
                    'is_active' => 1,
                    'created_by' => $getUser['id'],
                    'updated_by' => $getUser['id'],
                ]);
                $data_quotation[$i]['product_id'] = $product_id;
            }
        }


        return app(CreateInquiryQuotationTask::class)->run($data, $data_quotation);
    }
}
