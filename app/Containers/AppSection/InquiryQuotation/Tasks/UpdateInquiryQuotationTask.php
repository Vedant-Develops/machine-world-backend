<?php

namespace App\Containers\AppSection\InquiryQuotation\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\InquiryQuotation\Data\Repositories\InquiryQuotationRepository;
use App\Containers\AppSection\InquiryQuotation\Models\ClientInquiry;
use App\Containers\AppSection\InquiryQuotation\Models\InquiryQuotation;
use App\Containers\AppSection\InquiryQuotation\Models\Quotation;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateInquiryQuotationTask extends ParentTask
{
    use HashIdTrait;
    protected InquiryQuotationRepository $repository;
    public function __construct(InquiryQuotationRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($data, $create_data_quotation, $update_data_quotation, $id, $InputData)
    {
        try {
            $update = ClientInquiry::where('id', $id)->update($data);
            if (!empty($create_data_quotation)) {
                for ($i = 0; $i < count($create_data_quotation); $i++) {
                    $create_quotation[$i] = Quotation::create($create_data_quotation[$i]);
                }
            }
            $update_product = $InputData->getUpdateProducts();
            if (!empty($update_data_quotation)) {
                for ($i = 0, $j = 0; $i < count($update_data_quotation), $j < count($update_product); $i++, $j++) {
                    $id = $this->decode($update_product[$j]['id']);
                    $update_quotation[$i] = Quotation::where('id', $id)->update($update_data_quotation[$i]);
                }
            }
            if ($update) {
                $response['message'] = "Data Updated Successfully";
            } else {
                $response['message'] = "Failed To Update";
            }
            return $response;
        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
