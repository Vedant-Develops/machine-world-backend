<?php

namespace App\Containers\AppSection\InquiryQuotation\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\InquiryQuotation\Data\Repositories\InquiryQuotationRepository;
use App\Containers\AppSection\InquiryQuotation\Models\ClientInquiry;
use App\Containers\AppSection\InquiryQuotation\Models\InquiryQuotation;
use App\Containers\AppSection\InquiryQuotation\Models\Quotation;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use PhpParser\Node\Stmt\Return_;

class CreateInquiryQuotationTask extends ParentTask
{
    use HashIdTrait;
    protected InquiryQuotationRepository $repository;
    public function __construct(InquiryQuotationRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($data, $data_quotation)
    {
        try {
            $create = ClientInquiry::create($data);
            if (!empty($data_quotation)) {
                for ($i = 0; $i < count($data_quotation); $i++) {
                    $data_quotation[$i]['client_inquiry_id'] = $create->id;
                    $create_quotation[$i] = Quotation::create($data_quotation[$i]);
                }
            }
            $response['data'] = [
                'object' => "mw_client_inquiries",
                'id' => $this->encode($create->id),
                'inquiry_type' => $create->inquiry_type,
                'inquiry_code' => $create->inquiry_code,
                'client_name' => $create->client_name,
                'mobile' => $create->mobile,
                'email' => $create->email,
                'country' => $create->country,
                'state' => $create->state,
                'city' => $create->city,
                'village' => $create->village,
                'address' => $create->address,
                'company_name' => $create->company_name,
                'followup_date' => $create->followup_date,
                'remarks' => $create->remarks,
                'delivery_time_period' => $create->delivery_time_period,
                'is_active' => $create->is_active,
                'created_by' => $this->encode($create->created_by),
                'updated_by' => $this->encode($create->updated_by),
            ];
            return $response;
        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}
