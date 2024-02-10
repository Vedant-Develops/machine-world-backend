<?php

namespace App\Containers\AppSection\UserActivity\Actions;

use App\Containers\AppSection\UserActivity\Models\UserActivity;
use App\Containers\AppSection\UserActivity\Tasks\FindUserActivityByIdTask;
use App\Containers\AppSection\UserActivity\UI\API\Requests\FindUserActivityByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindUserActivityByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindUserActivityByIdRequest $request): UserActivity
    {
        return app(FindUserActivityByIdTask::class)->run($request->id);
    }
}
