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
            if (($field_db == "") || ($field_db == NULL)) {
                $product_data = Quotation::where('quotation_code', '!=', "")->paginate($per_page);
            } else {
                $product_data = Quotation::where('quotation_code', '!=', "")->where($field_db, 'like', '%' . $search_val . '%')->paginate($per_page);
            }
            $returnData_prod = [];

            if (!empty($product_data)) {

                for ($j = 0; $j < count($product_data); $j++) {
                    $returnData_prod[$j]['object'] = "mw_quotation";
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
