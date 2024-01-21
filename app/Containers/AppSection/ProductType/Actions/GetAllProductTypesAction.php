<?php

namespace App\Containers\AppSection\ProductType\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\ProductType\Tasks\GetAllProductTypesTask;
use App\Containers\AppSection\ProductType\UI\API\Requests\GetAllProductTypesRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllProductTypesAction extends ParentAction
{

    public function run(GetAllProductTypesRequest $request)
    {
        return app(GetAllProductTypesTask::class)->run();
    }
}
