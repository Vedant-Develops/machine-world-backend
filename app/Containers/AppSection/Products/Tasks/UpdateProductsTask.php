<?php

namespace App\Containers\AppSection\Products\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Products\Data\Repositories\ProductsRepository;
use App\Containers\AppSection\Products\Models\Products;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateProductsTask extends ParentTask
{
    use HashIdTrait;
    protected ProductsRepository $repository;
    public function __construct(ProductsRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($data, $id)
    {
        try {
            $products = $this->repository->update($data, $id);
            $image_api_url = Themesettings::where('id', 1)->first();
            $response['data'] = [
                'object' => $products->getResourceKey(),
                'id' => $products->getHashedKey(),
                "name" => $products->name,
                "product_type_id" => $this->encode($products->product_type_id),
                "height" => $products->height,
                "width" => $products->width,
                "length" => $products->length,
                "weight" => $products->weight,
                "power" => $products->power,
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
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
