<?php

namespace App\Containers\AppSection\Statemaster\Actions;

use App\Containers\AppSection\Statemaster\Tasks\DeleteStatemasterTask;
use App\Containers\AppSection\Statemaster\UI\API\Requests\DeleteStatemasterRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteStatemasterAction extends ParentAction
{

    public function run(DeleteStatemasterRequest $request)
    {
        return app(DeleteStatemasterTask::class)->run($request->id);
    }
}
