<?php

namespace App\Containers\AppSection\Products\UI\API\Transformers;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Products\Models\Products;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class ProductsTransformer extends ParentTransformer
{
    use HashIdTrait;
    protected array $defaultIncludes = [];

    protected array $availableIncludes = [];

    public function transform(Products $products): array
    {
        $image_api_url = Themesettings::where('id', 1)->first();
        $response = [
            'object' => $products->getResourceKey(),
            'id' => $products->getHashedKey(),
            "name" => $products->name,
            "product_type_id" => $this->encode($products->product_type_id),
            "height" => $products->height,
            "width" => $products->width,
            "length" => $products->length,
            "weight" => $products->weight,
            "product_video" => ($products->product_video) ? $image_api_url->image_api_url . $products->product_video : "",
            "product_image" => ($products->product_image) ? $image_api_url->image_api_url . $products->product_image : "",
            "product_specification" => $products->product_specification,
            "motor_type" => $products->motor_type,
            "diagram_type" => $products->diagram_type,
            "diagram_value" => $products->diagram_value,
            "price" => $products->price,
            "is_active" => $products->is_active,
            'created_at' => $products->created_at,
            'updated_at' => $products->updated_at,
        ];
        return $response;
        // return $this->ifAdmin([
        //     'real_id' => $products->id,
        //     'created_at' => $products->created_at,
        //     'updated_at' => $products->updated_at,
        //     'readable_created_at' => $products->created_at->diffForHumans(),
        //     'readable_updated_at' => $products->updated_at->diffForHumans(),
        //     // 'deleted_at' => $products->deleted_at,
        // ], $response);
    }
}
