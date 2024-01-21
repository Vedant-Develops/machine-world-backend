<?php

namespace App\Containers\AppSection\Products\Tasks;

use App\Containers\AppSection\Products\Data\Repositories\ProductsRepository;
use App\Containers\AppSection\Products\Models\Products;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateProductsByFieldTask extends ParentTask
{
    protected ProductsRepository $repository;
    public function __construct(ProductsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, $InputData)
    {
        try {
            $field_db = $InputData->getFieldDB();
            $search_val = $InputData->getSearchVal();
            if ($field_db == "is_active") {
                $update_status = Products::where('id', $id)->update(["is_active" => $search_val]);
            }

            if ($update_status == 1) {
                $returnData['message'] = "Status Updated Succesfully";
            } else {
                $returnData['message'] = "Failed to Update";
            }
            return $returnData;
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
