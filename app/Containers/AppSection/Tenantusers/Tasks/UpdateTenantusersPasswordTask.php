<?php

namespace App\Containers\AppSection\Tenantusers\Tasks;

use App\Containers\AppSection\Tenantusers\Data\Repositories\TenantusersRepository;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use Config;
use App\Containers\AppSection\Tenantusers\Models\Emailtemplate;
use App\Containers\AppSection\Themesettings\Models\Themesettings;

class UpdateTenantusersPasswordTask extends ParentTask
{
    protected TenantusersRepository $repository;

    public function __construct(TenantusersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($data, $tenant_id)

    {
        try {
            $data_update = $this->repository->update($data, $tenant_id);
            if (!empty($data_update)) {
                $returnData['message'] = "Password Updated Successfully";
            } else {
                $returnData['message'] = "Failed To Update";
            }

            return $returnData;
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
