<?php

namespace App\Containers\AppSection\Tenantusers\Tasks;

use App\Containers\AppSection\Tenantusers\Data\Repositories\TenantusersRepository;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateTenantusersTask extends ParentTask
{
    protected TenantusersRepository $repository;

    public function __construct(TenantusersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data, $id)
    {
        try {
            return $this->repository->update($data, $id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
