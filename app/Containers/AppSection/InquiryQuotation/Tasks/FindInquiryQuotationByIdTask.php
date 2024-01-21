<?php

namespace App\Containers\AppSection\InquiryQuotation\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\InquiryQuotation\Data\Repositories\InquiryQuotationRepository;
use App\Containers\AppSection\InquiryQuotation\Models\ClientInquiry;
use App\Containers\AppSection\InquiryQuotation\Models\InquiryQuotation;
use App\Containers\AppSection\InquiryQuotation\Models\Quotation;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindInquiryQuotationByIdTask extends ParentTask
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
            $returnData_prod = [];
            $getData = ClientInquiry::where('id', $id)->first();
            if (!empty($getData)) {
                $returnData['message'] = "Data found";
                $returnData['data']['object'] = "mw_client_inquiry";
                $returnData['data']['id'] = $this->encode($getData->id);
                $returnData['data']['inquiry_code'] = $getData->inquiry_code;
                $returnData['data']['client_name'] = $getData->client_name;
                $returnData['data']['mobile'] = $getData->mobile;
                $returnData['data']['email'] = $getData->email;
                $returnData['data']['country'] = $getData->country;
                $returnData['data']['state'] = $getData->state;
                $returnData['data']['city'] = $getData->city;
                $returnData['data']['village'] = $getData->village;
                $returnData['data']['address'] = $getData->address;
                $returnData['data']['company_name'] = $getData->company_name;
                $returnData['data']['followup_date'] = $getData->followup_date;
                $returnData['data']['remarks'] = $getData->remarks;
                $returnData['data']['delivery_time_period'] = $getData->delivery_time_period;
                $returnData['data']['is_active'] = $getData->is_active;
                $returnData['data']['created_by'] =  $this->encode($getData->created_by);
                $returnData['data']['updated_by'] = $this->encode($getData->updated_by);

                $product_data = Quotation::where('client_inquiry_id', $getData->id)->get();
                if (!empty($product_data)) {
                    for ($j = 0; $j < count($product_data); $j++) {
                        $returnData_prod[$j]['id'] = $this->encode($product_data[$j]->id);
                        $returnData_prod[$j]['client_inquiry_id'] =  $this->encode($product_data[$j]->client_inquiry_id);
                        $returnData_prod[$j]['inquiry_code'] = $product_data[$j]->inquiry_code;
                        $returnData_prod[$j]['quotation_code'] = $product_data[$j]->quotation_code;
                        $returnData_prod[$j]['product_name'] = $product_data[$j]->product_name;
                        $returnData_prod[$j]['qty'] = $product_data[$j]->qty;
                        $returnData_prod[$j]['base_price'] = $product_data[$j]->base_price;
                        $returnData_prod[$j]['extra_price'] = $product_data[$j]->extra_price;
                        $returnData_prod[$j]['discount_price'] = $product_data[$j]->discount_price;
                        $returnData_prod[$j]['remarks'] = $product_data[$j]->remarks;
                        $returnData_prod[$j]['is_active'] = $product_data[$j]->is_active;
                        $returnData_prod[$j]['created_by'] =  $this->encode($product_data[$j]->created_by);
                        $returnData_prod[$j]['updated_by'] =  $this->encode($product_data[$j]->updated_by);
                    }
                } else {
                    $returnData_prod = [];
                }
                $returnData['data']['quotation_data'] = $returnData_prod;

                $returnData['data']['created_at'] = $getData->created_at;
                $returnData['data']['updated_at'] = $getData->updated_at;
            } else {
                $returnData = [
                    'message' => 'Error: Data not found.',
                    'object' => 'mw_client_inquiry',
                    'data' => [],
                ];
            }
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to find the resource. Please try again later.',
                'object' => 'mw_client_inquiry',
                'data' => [],
            ];
        }
    }
}
