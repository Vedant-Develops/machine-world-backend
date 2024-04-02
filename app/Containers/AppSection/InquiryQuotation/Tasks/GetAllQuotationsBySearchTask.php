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

class GetAllQuotationsBySearchTask extends ParentTask
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
            $returnData = [];
            $per_page = (int) $InputData->getPerPage();
            $field_db = $InputData->getFieldDB();
            $search_val = $InputData->getSearchVal();
            $year = $InputData->getYear();
            $month = $InputData->getMonth();
            if (($field_db == "") || ($field_db == NULL)) {
                $product_data = Quotation::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->where('quotation_code', '!=', "")
                    ->orderBy('created_at', 'DESC')
                    ->paginate($per_page);
            } else {
                $product_data = Quotation::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->where('quotation_code', '!=', "")
                    ->orderBy('created_at', 'DESC')
                    ->where($field_db, 'like', '%' . $search_val . '%')
                    ->paginate($per_page);
            }
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
                            'created_at' => $product->created_at,
                            'updated_at' => $product->updated_at,
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

                $returnData['data'] = $returnData_prod;
                $returnData['meta']['pagination']['total'] = $product_data->total();
                $returnData['meta']['pagination']['count'] = $product_data->count();
                $returnData['meta']['pagination']['per_page'] = $product_data->perPage();
                $returnData['meta']['pagination']['current_page'] = $product_data->currentPage();
                $returnData['meta']['pagination']['total_pages'] = $product_data->lastPage();
                $returnData['meta']['pagination']['links']['previous'] = $product_data->previousPageUrl();
                $returnData['meta']['pagination']['links']['next'] = $product_data->nextPageUrl();
            } else {
                $returnData = [
                    'message' => 'Error: Data not found.',
                    'object' => 'mw_quotation',
                    'data' => [],
                ];
                $returnData['meta']['pagination']['total'] = $product_data->total();
                $returnData['meta']['pagination']['count'] = $product_data->count();
                $returnData['meta']['pagination']['per_page'] = $product_data->perPage();
                $returnData['meta']['pagination']['current_page'] = $product_data->currentPage();
                $returnData['meta']['pagination']['total_pages'] = $product_data->lastPage();
                $returnData['meta']['pagination']['links']['previous'] = $product_data->previousPageUrl();
                $returnData['meta']['pagination']['links']['next'] = $product_data->nextPageUrl();
            }
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to find the resource. Please try again later.',
                'object' => 'mw_quotation',
                'data' => [],
            ];
        }
    }
}
