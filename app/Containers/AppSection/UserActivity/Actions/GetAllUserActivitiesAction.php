<?php

namespace App\Containers\AppSection\UserActivity\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\UserActivity\Tasks\GetAllUserActivitiesTask;
use App\Containers\AppSection\UserActivity\UI\API\Requests\GetAllUserActivitiesRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllUserActivitiesAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllUserActivitiesRequest $request): mixed
    {
        return app(GetAllUserActivitiesTask::class)->run();
    }
}
