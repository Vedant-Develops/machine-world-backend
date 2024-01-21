<?php

namespace App\Containers\AppSection\ProductType\Tasks;

use App\Containers\AppSection\ProductType\Data\Repositories\ProductTypeRepository;
use App\Containers\AppSection\ProductType\Models\ProductType;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteProductTypeTask extends ParentTask
{
    protected ProductTypeRepository $repository;
    public function __construct(ProductTypeRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($id)
    {
        try {
            $getData = ProductType::where('id', $id)->first();
            if (!empty($getData)) {
                $delete_user = $this->repository->delete($id);
                $returnData['message'] = "Data Deleted Successfully";
                $returnData['object'] = "product_type";
            } else {
                $returnData['message'] = "Data not Found";
                $returnData['object'] = "product_type";
            }
            return $returnData;
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
