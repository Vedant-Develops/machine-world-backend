<?php

namespace App\Containers\AppSection\InquiryQuotation\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\InquiryQuotation\Data\Repositories\InquiryQuotationRepository;
use App\Containers\AppSection\InquiryQuotation\Models\ClientInquiry;
use App\Containers\AppSection\InquiryQuotation\Models\Quotation;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteInquiryQuotationTask extends ParentTask
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
            $flag = $InputData->getFlag();
            $search_val = $InputData->getSearchVal();
            if ($flag == "inquiry") {
                $delete_quotation = Quotation::where('inquiry_code', $search_val)->delete();
                $delete_inquiry = ClientInquiry::where('inquiry_code', $search_val)->delete();
                $returnData['message'] = "Data Deleted Successfully";
                $returnData['object'] = "mw_client_inquiries";
            } elseif ($flag == "quotation") {
                $delete_quotation = Quotation::where('quotation_code', $search_val)->delete();
                $returnData['message'] = "Data Deleted Successfully";
                $returnData['object'] = "mw_quotation";
            } elseif ($flag == "quotation_id") {
                $search_val = $this->decode($search_val);

                $delete_quotation = Quotation::where('id', $search_val)->delete();
                $returnData['message'] = "Data Deleted Successfully";
                $returnData['object'] = "mw_quotation";
            } else {
                $returnData['message'] = "Please Send Required Flag";
            }
            return $returnData;
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
