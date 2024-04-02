<?php

namespace App\Containers\AppSection\Statemaster\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Statemaster\Tasks\GetAllStatemastersBySearchTask;
use App\Containers\AppSection\Statemaster\UI\API\Requests\GetAllStatemastersRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllStatemastersBySearchAction extends ParentAction
{

    public function run(GetAllStatemastersRequest $request, $InputData)
    {
        return app(GetAllStatemastersBySearchTask::class)->run($InputData);
    }
}
