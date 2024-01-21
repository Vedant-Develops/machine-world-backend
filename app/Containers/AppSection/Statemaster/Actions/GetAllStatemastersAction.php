<?php

namespace App\Containers\AppSection\Statemaster\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Statemaster\Tasks\GetAllStatemastersTask;
use App\Containers\AppSection\Statemaster\UI\API\Requests\GetAllStatemastersRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllStatemastersAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllStatemastersRequest $request): mixed
    {
        return app(GetAllStatemastersTask::class)->run();
    }
}
