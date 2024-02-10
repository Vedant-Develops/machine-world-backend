<?php

namespace App\Containers\AppSection\InquiryQuotation\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\InquiryQuotation\Data\Repositories\InquiryQuotationRepository;
use App\Containers\AppSection\InquiryQuotation\Models\ClientInquiry;
use App\Containers\AppSection\InquiryQuotation\Models\Quotation;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllInquiryQuotationsTask extends ParentTask
{
    use HashIdTrait;
    protected InquiryQuotationRepository $repository;
    public function __construct(InquiryQuotationRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run(): mixed
    {
        try {
            $getData = ClientInquiry::get();

            if (!empty($getData) && count($getData) >= 1) {
                $returnData['message'] = "Data found";

                for ($i = 0; $i < count($getData); $i++) {
                    $returnData['data'][$i]['object'] = "mw_client_inquiry";
                    $returnData['data'][$i]['id'] = $this->encode($getData[$i]->id);
                    $returnData['data'][$i]['inquiry_code'] = $getData[$i]->inquiry_code;
                    $returnData['data'][$i]['client_name'] = $getData[$i]->client_name;
                    $returnData['data'][$i]['mobile'] = $getData[$i]->mobile;
                    $returnData['data'][$i]['email'] = $getData[$i]->email;
                    $returnData['data'][$i]['country'] = $getData[$i]->country;
                    $returnData['data'][$i]['state'] = $getData[$i]->state;
                    $returnData['data'][$i]['city'] = $getData[$i]->city;
                    $returnData['data'][$i]['village'] = $getData[$i]->village;
                    $returnData['data'][$i]['address'] = $getData[$i]->address;
                    $returnData['data'][$i]['company_name'] = $getData[$i]->company_name;
                    $returnData['data'][$i]['followup_date'] = $getData[$i]->followup_date;
                    $returnData['data'][$i]['existing_machines'] = $getData[$i]->existing_machines;
                    $returnData['data'][$i]['remarks'] = $getData[$i]->remarks;
                    $returnData['data'][$i]['delivery_time_period'] = $getData[$i]->delivery_time_period;
                    $returnData['data'][$i]['is_active'] = $getData[$i]->is_active;
                    $returnData['data'][$i]['created_by'] =  $this->encode($getData[$i]->created_by);
                    $returnData['data'][$i]['updated_by'] =  $this->encode($getData[$i]->updated_by);
                    $product_data = Quotation::where('client_inquiry_id', $getData[$i]->id)->get();
                    $returnData_prod = [];
                    if (!empty($product_data)) {

                        for ($j = 0; $j < count($product_data); $j++) {
                            $returnData_prod[$j]['id'] = $this->encode($product_data[$j]->id);
                            //   $returnData_prod[$j]['client_inquiry_id'] =  $this->encode($product_data[$j]->client_inquiry_id);
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
                    $returnData['data'][$i]['quotation_data'] = $returnData_prod;

                    $returnData['data'][$i]['created_at'] = $getData[$i]->created_at;
                    $returnData['data'][$i]['updated_at'] = $getData[$i]->updated_at;
                }
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
