<?php

namespace App\Containers\AppSection\Role\Tasks;

use App\Containers\AppSection\Role\Data\Repositories\RoleRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteRoleTask extends ParentTask
{
    protected RoleRepository $repository;
    public function __construct(RoleRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run($id): int
    {
        try {
            return $this->repository->delete($id);
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
