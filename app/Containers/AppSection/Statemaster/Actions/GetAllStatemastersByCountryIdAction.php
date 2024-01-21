<?php

namespace App\Containers\AppSection\Statemaster\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Statemaster\Tasks\GetAllStatemastersByCountryIdTask;
use App\Containers\AppSection\Statemaster\UI\API\Requests\FindStatemasterByIdRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllStatemastersByCountryIdAction extends ParentAction
{

    public function run(FindStatemasterByIdRequest $request)
    {
        return app(GetAllStatemastersByCountryIdTask::class)->run($request->id);
    }
}
