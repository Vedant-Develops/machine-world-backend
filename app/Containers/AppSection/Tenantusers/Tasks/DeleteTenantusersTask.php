<?php

namespace App\Containers\AppSection\Tenantusers\Tasks;

use App\Containers\AppSection\Tenantusers\Data\Repositories\TenantusersRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteTenantusersTask extends ParentTask
{
    protected TenantusersRepository $repository;
    public function __construct(TenantusersRepository $repository)
    {
        $this->repository = $repository;
    }



    public function run($id)
    {
        try {
            $delete = $this->repository->delete($id);
            $returnData['message'] = "Data Deleted Successfully";
            return $returnData;
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
