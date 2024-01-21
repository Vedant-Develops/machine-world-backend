<?php

namespace App\Containers\AppSection\Products\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Products\Tasks\GetAllProductsBySearchTask;
use App\Containers\AppSection\Products\UI\API\Requests\GetAllProductsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllProductsBySearchAction extends ParentAction
{

    public function run(GetAllProductsRequest $request, $InputData)
    {
        return app(GetAllProductsBySearchTask::class)->run($InputData);
    }
}
