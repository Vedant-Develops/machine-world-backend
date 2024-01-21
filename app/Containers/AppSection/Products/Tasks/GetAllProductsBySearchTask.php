<?php

namespace App\Containers\AppSection\Products\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Products\Data\Repositories\ProductsRepository;
use App\Containers\AppSection\Products\Models\Products;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllProductsBySearchTask extends ParentTask
{
    use HashIdTrait;
    protected ProductsRepository $repository;
    public function __construct(ProductsRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($InputData)
    {
        try {
            $returnData = [];
            $per_page = (int) $InputData->getPerPage();
            $field_db = $InputData->getFieldDB();
            $search_val = $InputData->getSearchVal();
            $image_api_url = Themesettings::where('id', 1)->first();
            if (($field_db == "") || ($field_db == NULL)) {
                $products = Products::paginate($per_page);
            } else {
                if ($field_db == "product_type_id") {
                    $search_val = $this->decode($search_val);
                }

                $products = Products::where($field_db, 'like', '%' . $search_val . '%')->paginate($per_page);
            }
            $image_api_url = Themesettings::where('id', 1)->first();
            if (!empty($products)) {
                for ($i = 0; $i < count($products); $i++) {
                    $returnData['data'][$i] = [
                        'object' => $products[$i]->getResourceKey(),
                        'id' => $products[$i]->getHashedKey(),
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
                $returnData['meta']['pagination']['total'] = $products->total();
                $returnData['meta']['pagination']['count'] = $products->count();
                $returnData['meta']['pagination']['per_page'] = $products->perPage();
                $returnData['meta']['pagination']['current_page'] = $products->currentPage();
                $returnData['meta']['pagination']['total_pages'] = $products->lastPage();
                $returnData['meta']['pagination']['links']['previous'] = $products->previousPageUrl();
                $returnData['meta']['pagination']['links']['next'] = $products->nextPageUrl();
            } else {
                $returnData['message'] = "No Data found";
                $returnData['meta']['pagination']['total'] = $products->total();
                $returnData['meta']['pagination']['count'] = $products->count();
                $returnData['meta']['pagination']['per_page'] = $products->perPage();
                $returnData['meta']['pagination']['current_page'] = $products->currentPage();
                $returnData['meta']['pagination']['total_pages'] = $products->lastPage();
                $returnData['meta']['pagination']['links']['previous'] = $products->previousPageUrl();
                $returnData['meta']['pagination']['links']['next'] = $products->nextPageUrl();
            }
            return $returnData;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
