<?php

namespace App\Containers\AppSection\Countrymaster\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Countrymaster\Tasks\GetAllCountrymastersTask;
use App\Containers\AppSection\Countrymaster\UI\API\Requests\GetAllCountrymastersRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllCountrymastersAction extends ParentAction
{
    public function run(GetAllCountrymastersRequest $request)
    {
        return app(GetAllCountrymastersTask::class)->run();
    }
}
