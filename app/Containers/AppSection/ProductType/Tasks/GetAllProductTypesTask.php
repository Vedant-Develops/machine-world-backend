<?php

namespace App\Containers\AppSection\ProductType\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\ProductType\Data\Repositories\ProductTypeRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllProductTypesTask extends ParentTask
{
    protected ProductTypeRepository $repository;
    public function __construct(ProductTypeRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run()
    {
        return $this->addRequestCriteria()->repository->paginate();
    }
}
