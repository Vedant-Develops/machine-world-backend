<?php

namespace App\Containers\AppSection\Role\Tasks;

use App\Containers\AppSection\Role\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Role\Models\Role;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateRoleTask extends ParentTask
{
    protected RoleRepository $repository;
    public function __construct(RoleRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
