<?php

namespace App\Containers\AppSection\InquiryQuotation\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\InquiryQuotation\Models\ClientInquiry;
use App\Containers\AppSection\InquiryQuotation\Models\InquiryQuotation;
use App\Containers\AppSection\InquiryQuotation\Models\Quotation;
use App\Containers\AppSection\InquiryQuotation\Tasks\UpdateInquiryQuotationTask;
use App\Containers\AppSection\InquiryQuotation\UI\API\Requests\UpdateInquiryQuotationRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Auth;

class UpdateInquiryQuotationAction extends ParentAction
{

    public function run(UpdateInquiryQuotationRequest $request, $InputData)
    {
        $getUser = Auth::user();


        $get_cl_inquiry = ClientInquiry::withTrashed()->where('id', $request->id)->first();
        $check_quotation_code = Quotation::withTrashed()->where('client_inquiry_id', $get_cl_inquiry->id)->first();
        $count_no = 0;
        if (empty($check_quotation_code->quotation_code)) {
            $get_latest_quotation_code = Quotation::withTrashed()->where('quotation_code', '!=', "")->count();
            if ($get_latest_quotation_code >= 1) {
                $count_no = $get_latest_quotation_code + 1;
            } else {
                $count_no = 1;
            }

            $year = date('Y');
            $characters = 'MW-QTA-' . $year . '-';
            $charactersLength = strlen($characters);
            $count = 0;
            do {
                $quo_code = $characters . sprintf("%05d", $count_no + $count++);
            } while (Quotation::where('quotation_code', $quo_code)->exists());
        } else {
            $quo_code = $check_quotation_code->quotation_code;
        }

        $data = $request->sanitizeInput([
            'client_name' => $InputData->getClientName(),
            'mobile' => $InputData->getMobile(),
            'email' => $InputData->getEmail(),
            'country' => $InputData->getCountry(),
            'state' => $InputData->getState(),
            'city' => $InputData->getCity(),
            'village' => $InputData->getVillage(),
            'address' => $InputData->getAddress(),
            'company_name' => $InputData->getCompanyName(),
            'followup_date' => $InputData->getFollowupDate(),
            'existing_machines' => $InputData->getExistingMachines(),
            'remarks' => $InputData->getRemarks(),
            'delivery_time_period' => $InputData->getDeliveryTimePeriod(),
            'updated_by' => $getUser['id'],
        ]);
        $data = array_filter($data);


        $create_product = $InputData->getCreateProducts();

        $create_data_quotation = [];
        if (!empty($create_product)) {
            for ($i = 0; $i < count($create_product); $i++) {
                $create_data_quotation[$i] = $request->sanitizeInput([
                    'client_inquiry_id' => $get_cl_inquiry->id,
                    'inquiry_code' => $get_cl_inquiry->inquiry_code,
                    'quotation_code' => $quo_code,
                    'product_name' => $create_product[$i]['product_name'],
                    'qty' => $create_product[$i]['qty'],
                    'base_price' => $create_product[$i]['base_price'],
                    'extra_price' => $create_product[$i]['extra_price'],
                    'discount_price' => $create_product[$i]['discount_price'],
                    'remarks' => $create_product[$i]['remarks'],
                    'is_active' => 1,
                    'created_by' => $getUser['id'],
                    'updated_by' => $getUser['id'],
                ]);
            }
        }

        $create_data_quotation = array_filter($create_data_quotation);

        $update_product = $InputData->getUpdateProducts();

        $update_data_quotation = [];
        if (!empty($update_product)) {
            for ($i = 0; $i < count($update_product); $i++) {
                $update_data_quotation[$i] = $request->sanitizeInput([
                    'quotation_code' => $quo_code,
                    'product_name' => $update_product[$i]['product_name'],
                    'qty' => $update_product[$i]['qty'],
                    'base_price' => $update_product[$i]['base_price'],
                    'extra_price' => $update_product[$i]['extra_price'],
                    'discount_price' => $update_product[$i]['discount_price'],
                    'remarks' => $update_product[$i]['remarks'],
                    'updated_by' => $getUser['id'],
                ]);
            }
        }

        $update_data_quotation  = array_filter($update_data_quotation);

        return app(UpdateInquiryQuotationTask::class)->run($data, $create_data_quotation, $update_data_quotation, $request->id, $InputData);
    }
}
