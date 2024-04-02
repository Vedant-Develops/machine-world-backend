<?php

namespace App\Containers\AppSection\InquiryQuotation\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\InquiryQuotation\Data\Repositories\InquiryQuotationRepository;
use App\Containers\AppSection\InquiryQuotation\Models\ClientInquiry;
use App\Containers\AppSection\InquiryQuotation\Models\InquiryQuotation;
use App\Containers\AppSection\InquiryQuotation\Models\Quotation;
use App\Containers\AppSection\Products\Models\Products;
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
                $returnData['data']['country_id'] = $this->encode($getData->country_id);
                $returnData['data']['state_id'] = $this->encode($getData->state_id);
                $returnData['data']['city_id'] = $this->encode($getData->city_id);
                $returnData['data']['village'] = $getData->village;
                $returnData['data']['address'] = $getData->address;
                $returnData['data']['company_name'] = $getData->company_name;
                $returnData['data']['followup_date'] = $getData->followup_date;
                $returnData['data']['existing_machines'] = $getData->existing_machines;
                $returnData['data']['remarks'] = $getData->remarks;
                $returnData['data']['delivery_time_period'] = $getData->delivery_time_period;
                $returnData['data']['is_active'] = $getData->is_active;
                $returnData['data']['created_by'] =  $this->encode($getData->created_by);
                $returnData['data']['updated_by'] = $this->encode($getData->updated_by);

                $product_data = Quotation::where('client_inquiry_id', $getData->id)->get();
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
                                        'product_specification' => Products::find($product->product_id)->product_specification ?? "",
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
                                'product_specification' =>  Products::find($product->product_id)->product_specification ?? "",
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
