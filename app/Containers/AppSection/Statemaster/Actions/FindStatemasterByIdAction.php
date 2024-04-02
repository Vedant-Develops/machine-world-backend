<?php

namespace App\Containers\AppSection\Statemaster\Actions;

use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Containers\AppSection\Statemaster\Tasks\FindStatemasterByIdTask;
use App\Containers\AppSection\Statemaster\UI\API\Requests\FindStatemasterByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindStatemasterByIdAction extends ParentAction
{

    public function run(FindStatemasterByIdRequest $request)
    {
        return app(FindStatemasterByIdTask::class)->run($request->id);
    }
}
