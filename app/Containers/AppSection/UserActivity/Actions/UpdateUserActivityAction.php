<?php

namespace App\Containers\AppSection\UserActivity\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\UserActivity\Models\UserActivity;
use App\Containers\AppSection\UserActivity\Tasks\UpdateUserActivityTask;
use App\Containers\AppSection\UserActivity\UI\API\Requests\UpdateUserActivityRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateUserActivityAction extends ParentAction
{
    /**
     * @param UpdateUserActivityRequest $request
     * @return UserActivity
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateUserActivityRequest $request): UserActivity
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(UpdateUserActivityTask::class)->run($data, $request->id);
    }
}
