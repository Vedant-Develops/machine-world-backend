<?php

namespace App\Containers\AppSection\Tenantusers\Actions;

use App\Containers\AppSection\Tenantusers\Tasks\DeleteTenantusersTask;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\DeleteTenantusersRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteTenantusersAction extends ParentAction
{
    /**
     * @param DeleteTenantusersRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteTenantusersRequest $request)
    {
        return app(DeleteTenantusersTask::class)->run($request->id);
    }
}
