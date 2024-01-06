<?php

namespace App\Containers\AppSection\Role\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Role\Tasks\GetAllRolesTask;
use App\Containers\AppSection\Role\UI\API\Requests\GetAllRolesRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllRolesAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllRolesRequest $request): mixed
    {
        return app(GetAllRolesTask::class)->run();
    }
}
