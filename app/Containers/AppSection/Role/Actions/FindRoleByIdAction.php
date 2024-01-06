<?php

namespace App\Containers\AppSection\Role\Actions;

use App\Containers\AppSection\Role\Models\Role;
use App\Containers\AppSection\Role\Tasks\FindRoleByIdTask;
use App\Containers\AppSection\Role\UI\API\Requests\FindRoleByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindRoleByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindRoleByIdRequest $request): Role
    {
        return app(FindRoleByIdTask::class)->run($request->id);
    }
}
