<?php

namespace App\Containers\AppSection\Role\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Role\Data\Repositories\RoleRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllRolesTask extends ParentTask
{
    protected RoleRepository $repository;
    public function __construct(RoleRepository $repository) {
        $this->repository = $repository;
    }

    public function run(): mixed
    {
        return $this->addRequestCriteria()->repository->paginate();
    }
}
