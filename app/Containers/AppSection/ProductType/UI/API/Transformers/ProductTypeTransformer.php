<?php

namespace App\Containers\AppSection\ProductType\UI\API\Transformers;

use App\Containers\AppSection\ProductType\Models\ProductType;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class ProductTypeTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [];

    protected array $availableIncludes = [];

    public function transform(ProductType $producttype): array
    {
        $response = [
            'object' => $producttype->getResourceKey(),
            'id' => $producttype->getHashedKey(),
            "type" => $producttype->type,
            "is_active" => $producttype->is_active,
            'created_at' => $producttype->created_at,
            'updated_at' => $producttype->updated_at,
        ];
        return $response;

        // return $this->ifAdmin([
        //     'real_id' => $producttype->id,
        //     'created_at' => $producttype->created_at,
        //     'updated_at' => $producttype->updated_at,
        //     'readable_created_at' => $producttype->created_at->diffForHumans(),
        //     'readable_updated_at' => $producttype->updated_at->diffForHumans(),
        //     // 'deleted_at' => $producttype->deleted_at,
        // ], $response);
    }
}
