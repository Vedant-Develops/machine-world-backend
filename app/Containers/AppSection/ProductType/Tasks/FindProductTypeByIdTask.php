<?php

namespace App\Containers\AppSection\ProductType\Tasks;

use App\Containers\AppSection\ProductType\Data\Repositories\ProductTypeRepository;
use App\Containers\AppSection\ProductType\Models\ProductType;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindProductTypeByIdTask extends ParentTask
{
    protected ProductTypeRepository $repository;
    public function __construct(ProductTypeRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($id)
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
