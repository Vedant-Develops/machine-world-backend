<?php

namespace App\Containers\AppSection\Statemaster\Actions;

use App\Containers\AppSection\Statemaster\Tasks\DeleteStatemasterTask;
use App\Containers\AppSection\Statemaster\UI\API\Requests\DeleteStatemasterRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteStatemasterAction extends ParentAction
{
    /**
     * @param DeleteStatemasterRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteStatemasterRequest $request): int
    {
        return app(DeleteStatemasterTask::class)->run($request->id);
    }
}
