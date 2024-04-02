<?php

namespace App\Containers\AppSection\Products\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Products\Data\Repositories\ProductsRepository;
use App\Containers\AppSection\Products\Models\Products;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllProductsTask extends ParentTask
{
    use HashIdTrait;
    public function __construct(
        protected ProductsRepository $repository
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run()
    {
        //  try {
        $returnData = [];

        // $image_api_url = Themesettings::where('id', 1)->first();
        $products = Products::get();

        $image_api_url = Themesettings::where('id', 1)->first();
        if (!empty($products)) {
            for ($i = 0; $i < count($products); $i++) {
                $returnData['data'][$i] = [
                    'object' => 'Products',
                    'id' => $this->encode($products[$i]->id),
                    "name" => $products[$i]->name,
                    "product_type_id" => $this->encode($products[$i]->product_type_id),
                    "height" => $products[$i]->height,
                    "width" => $products[$i]->width,
                    "length" => $products[$i]->length,
                    "weight" => $products[$i]->weight,
                    "power" => $products[$i]->power,
                    "product_video" => ($products[$i]->product_video) ? $image_api_url->image_api_url . $products[$i]->product_video : "",
                    "product_image" => ($products[$i]->product_image) ? $image_api_url->image_api_url . $products[$i]->product_image : "",
                    "product_specification" => $products[$i]->product_specification,
                    "motor_type" => $products[$i]->motor_type,
                    "diagram_type" => $products[$i]->diagram_type,
                    "diagram_value" => $products[$i]->diagram_value,
                    "price" => $products[$i]->price,
                    "is_active" => $products[$i]->is_active,
                    'created_at' => $products[$i]->created_at,
                    'updated_at' => $products[$i]->updated_at,
                ];
            }
        } else {
            $returnData['message'] = "No Data found";
        }
        return $returnData;
        // } catch (\Throwable $th) {
        //     throw $th;
        // }
    }
}
