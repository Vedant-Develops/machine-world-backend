<?php

namespace App\Containers\AppSection\Tenantusers\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Containers\AppSection\Tenantusers\Tasks\ResetTenantusersPasswordTask;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\CreateTenantusersRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class ResetTenantusersPasswordAction extends ParentAction
{

    public function run(CreateTenantusersRequest $request, $InputData)
    {

        return app(ResetTenantusersPasswordTask::class)->run($InputData);
    }
}
