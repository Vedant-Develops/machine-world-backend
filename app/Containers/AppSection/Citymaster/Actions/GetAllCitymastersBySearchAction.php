<?php

namespace App\Containers\AppSection\Citymaster\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Citymaster\Tasks\GetAllCitymastersBySearchTask;
use App\Containers\AppSection\Citymaster\UI\API\Requests\GetAllCitymastersRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllCitymastersBySearchAction extends ParentAction
{

    public function run(GetAllCitymastersRequest $request, $InputData)
    {
        return app(GetAllCitymastersBySearchTask::class)->run($InputData);
    }
}
