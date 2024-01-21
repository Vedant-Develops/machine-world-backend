<?php

namespace App\Containers\AppSection\ProductType\Tasks;

use App\Containers\AppSection\ProductType\Data\Repositories\ProductTypeRepository;
use App\Containers\AppSection\ProductType\Models\ProductType;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateProductTypeStatusTask extends ParentTask
{
    protected ProductTypeRepository $repository;
    public function __construct(ProductTypeRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($InputData, $id)
    {
        try {
            $field_db = $InputData->getFieldDB();
            $search_val = $InputData->getSearchVal();
            if ($field_db == "is_active") {
                $update_status = ProductType::where('id', $id)->update(["is_active" => $search_val]);
            }

            if ($update_status == 1) {
                $returnData['message'] = "Status Updated Succesfully";
            } else {
                $returnData['message'] = "Failed to Update";
            }
            return $returnData;
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
