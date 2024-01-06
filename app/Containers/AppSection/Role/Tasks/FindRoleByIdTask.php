<?php

namespace App\Containers\AppSection\Role\Tasks;

use App\Containers\AppSection\Role\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Role\Models\Role;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindRoleByIdTask extends ParentTask
{
    protected RoleRepository $repository;
    public function __construct(RoleRepository $repository) {
        $this->repository = $repository;
    }


    /**
     * @throws NotFoundException
     */
    public function run($id): Role
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
