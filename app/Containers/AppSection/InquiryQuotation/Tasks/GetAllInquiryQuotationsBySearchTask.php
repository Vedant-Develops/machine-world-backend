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

class GetAllInquiryQuotationsBySearchTask extends ParentTask
{
    use HashIdTrait;
    protected InquiryQuotationRepository $repository;
    public function __construct(InquiryQuotationRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($InputData)
    {
        try {

            $per_page = (int) $InputData->getPerPage();
            $field_db = $InputData->getFieldDB();
            $search_val = $InputData->getSearchVal();
            $year = $InputData->getYear();
            $month = $InputData->getMonth();
            if (($field_db == "") || ($field_db == NULL)) {
                $getData = ClientInquiry::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->orderBy('created_at', 'DESC')
                    ->paginate($per_page);
            } else {
                $getData = ClientInquiry::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->orderBy('created_at', 'DESC')
                    ->where($field_db, 'like', '%' . $search_val . '%')
                    ->paginate($per_page);
            }

            if (!empty($getData) && count($getData) >= 1) {
                $returnData['message'] = "Data found";

                for ($i = 0; $i < count($getData); $i++) {
                    $returnData['data'][$i]['object'] = "mw_client_inquiry";
                    $returnData['data'][$i]['id'] = $this->encode($getData[$i]->id);
                    $returnData['data'][$i]['inquiry_code'] = $getData[$i]->inquiry_code;
                    $returnData['data'][$i]['client_name'] = $getData[$i]->client_name;
                    $returnData['data'][$i]['mobile'] = $getData[$i]->mobile;
                    $returnData['data'][$i]['email'] = $getData[$i]->email;
                    $returnData['data'][$i]['country_id'] = $this->encode($getData[$i]->country_id);
                    $returnData['data'][$i]['state_id'] = $this->encode($getData[$i]->state_id);
                    $returnData['data'][$i]['city_id'] = $this->encode($getData[$i]->city_id);
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
                        foreach ($product_data as $j => $product) {
                            $quotationCode = $product->quotation_code;
                            $quotationIndex = array_search($quotationCode, array_column($returnData_prod, 'quotation_code'));
                            if ($quotationIndex === false) {
                                $returnData_prod[] = [
                                    'client_inquiry_id' => $this->encode($product->client_inquiry_id),
                                    'inquiry_code' => $product->inquiry_code,
                                    'quotation_code' => $quotationCode,
                                    'created_by' => $this->encode($product->created_by),
                                    'updated_by' => $this->encode($product->updated_by),
                                    'products' => [
                                        [
                                            'quotation_id' => $this->encode($product->id),
                                            'product_id' =>  $this->encode($product->product_id),
                                            'product_name' => $product->product_name,
                                            'qty' => $product->qty,
                                            'base_price' => $product->base_price,
                                            'extra_price' => $product->extra_price,
                                            'discount_price' => $product->discount_price,
                                            'remarks' => $product->remarks,
                                        ],
                                    ],
                                ];
                            } else {
                                $returnData_prod[$quotationIndex]['products'][] = [
                                    'quotation_id' => $this->encode($product->id),
                                    'product_id' =>  $this->encode($product->product_id),
                                    'product_name' => $product->product_name,
                                    'qty' => $product->qty,
                                    'base_price' => $product->base_price,
                                    'extra_price' => $product->extra_price,
                                    'discount_price' => $product->discount_price,
                                    'remarks' => $product->remarks,
                                ];
                            }
                        }
                    } else {
                        $returnData_prod = [];
                    }
                    $returnData['data'][$i]['quotation_data'] = $returnData_prod;

                    $returnData['data'][$i]['created_at'] = $getData[$i]->created_at;
                    $returnData['data'][$i]['updated_at'] = $getData[$i]->updated_at;
                }

                $returnData['meta']['pagination']['total'] = $getData->total();
                $returnData['meta']['pagination']['count'] = $getData->count();
                $returnData['meta']['pagination']['per_page'] = $getData->perPage();
                $returnData['meta']['pagination']['current_page'] = $getData->currentPage();
                $returnData['meta']['pagination']['total_pages'] = $getData->lastPage();
                $returnData['meta']['pagination']['links']['previous'] = $getData->previousPageUrl();
                $returnData['meta']['pagination']['links']['next'] = $getData->nextPageUrl();
            } else {
                $returnData = [
                    'message' => 'Error: Data not found.',
                    'object' => 'mw_client_inquiry',
                    'data' => [],
                ];
                $returnData['meta']['pagination']['total'] = $getData->total();
                $returnData['meta']['pagination']['count'] = $getData->count();
                $returnData['meta']['pagination']['per_page'] = $getData->perPage();
                $returnData['meta']['pagination']['current_page'] = $getData->currentPage();
                $returnData['meta']['pagination']['total_pages'] = $getData->lastPage();
                $returnData['meta']['pagination']['links']['previous'] = $getData->previousPageUrl();
                $returnData['meta']['pagination']['links']['next'] = $getData->nextPageUrl();
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
