<?php

namespace App\Containers\AppSection\Tenantusers\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Tenantusers\Tasks\GetAllTenantusersTask;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\GetAllTenantusersRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllTenantusersAction extends ParentAction
{
  
    public function run(GetAllTenantusersRequest $request,$InputData)
    {
        return app(GetAllTenantusersTask::class)->run($InputData);
    }
}
