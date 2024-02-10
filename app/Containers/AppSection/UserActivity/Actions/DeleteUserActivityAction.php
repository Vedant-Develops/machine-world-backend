<?php

namespace App\Containers\AppSection\UserActivity\Actions;

use App\Containers\AppSection\UserActivity\Tasks\DeleteUserActivityTask;
use App\Containers\AppSection\UserActivity\UI\API\Requests\DeleteUserActivityRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteUserActivityAction extends ParentAction
{
    /**
     * @param DeleteUserActivityRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteUserActivityRequest $request): int
    {
        return app(DeleteUserActivityTask::class)->run($request->id);
    }
}
