<?php

namespace App\Containers\AppSection\Products\Actions;

use App\Containers\AppSection\Products\Tasks\DeleteProductsTask;
use App\Containers\AppSection\Products\UI\API\Requests\DeleteProductsRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteProductsAction extends ParentAction
{

    public function run(DeleteProductsRequest $request)
    {
        return app(DeleteProductsTask::class)->run($request->id);
    }
}
