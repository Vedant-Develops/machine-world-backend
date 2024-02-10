<?php

namespace App\Containers\AppSection\UserActivity\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\UserActivity\Tasks\GetAllUserActivitiesBySearchTask;
use App\Containers\AppSection\UserActivity\UI\API\Requests\GetAllUserActivitiesRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllUserActivitiesBySearchAction extends ParentAction
{

    public function run(GetAllUserActivitiesRequest $request, $InputData)
    {
        return app(GetAllUserActivitiesBySearchTask::class)->run($InputData);
    }
}
