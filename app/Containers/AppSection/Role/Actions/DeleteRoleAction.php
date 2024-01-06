<?php

namespace App\Containers\AppSection\Role\Actions;

use App\Containers\AppSection\Role\Tasks\DeleteRoleTask;
use App\Containers\AppSection\Role\UI\API\Requests\DeleteRoleRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteRoleAction extends ParentAction
{
    /**
     * @param DeleteRoleRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteRoleRequest $request): int
    {
        return app(DeleteRoleTask::class)->run($request->id);
    }
}
