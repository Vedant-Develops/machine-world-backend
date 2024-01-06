<?php

namespace App\Containers\AppSection\Tenantusers\Tasks;

use App\Containers\AppSection\Tenantusers\Data\Repositories\TenantusersRepository;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateTenantusersByFieldsTask extends ParentTask
{
    protected TenantusersRepository $repository;

    public function __construct(TenantusersRepository $repository)
    {
        $this->repository = $repository;
    }

   
    public function  run($id, $InputData)
    {
        try {
            $field_db = $InputData->getFieldDB();
            $search_val = $InputData->getSearchVal();
            $update_status = Tenantusers::where('id', $id)->update([$field_db => $search_val]);
            if ($update_status == 1) {
                $returnData['message'] = "Field Updated Succesfully";
            } else {
                $returnData['message'] = "Failed to Update";
            }
            return $returnData;
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
