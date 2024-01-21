<?php

namespace App\Containers\AppSection\Products\Tasks;

use App\Containers\AppSection\Products\Data\Repositories\ProductsRepository;
use App\Containers\AppSection\Products\Models\Products;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindProductsByIdTask extends ParentTask
{
    public function __construct(
        protected ProductsRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Products
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
