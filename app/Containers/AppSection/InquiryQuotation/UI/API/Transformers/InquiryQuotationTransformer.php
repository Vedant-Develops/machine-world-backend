<?php

namespace App\Containers\AppSection\InquiryQuotation\UI\API\Transformers;

use App\Containers\AppSection\InquiryQuotation\Models\ClientInquiry;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class InquiryQuotationTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(ClientInquiry $inquiryquotation): array
    {
        $response = [
            'object' => $inquiryquotation->getResourceKey(),
            'id' => $inquiryquotation->getHashedKey(),
        ];

        return $this->ifAdmin([
            'real_id' => $inquiryquotation->id,
            'created_at' => $inquiryquotation->created_at,
            'updated_at' => $inquiryquotation->updated_at,
            'readable_created_at' => $inquiryquotation->created_at->diffForHumans(),
            'readable_updated_at' => $inquiryquotation->updated_at->diffForHumans(),
            // 'deleted_at' => $inquiryquotation->deleted_at,
        ], $response);
    }
}
