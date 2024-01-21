<?php

namespace App\Containers\AppSection\InquiryQuotation\Tasks;

use App\Containers\AppSection\InquiryQuotation\Data\Repositories\InquiryQuotationRepository;
use App\Containers\AppSection\InquiryQuotation\Models\Quotation;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteInquiryQuotationTask extends ParentTask
{
    protected InquiryQuotationRepository $repository;
    public function __construct(InquiryQuotationRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($id)
    {
        try {
            $getData = Quotation::where('id', $id)->first();
            if (!empty($getData)) {
                $delete_user = Quotation::where('id', $id)->delete($id);
                $returnData['message'] = "Data Deleted Successfully";
                $returnData['object'] = "mw_quotation";
            } else {
                $returnData['message'] = "Data not Found";
                $returnData['object'] = "mw_quotation";
            }
            return $returnData;
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
