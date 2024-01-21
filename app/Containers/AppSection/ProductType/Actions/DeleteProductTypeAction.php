<?php

namespace App\Containers\AppSection\ProductType\Actions;

use App\Containers\AppSection\ProductType\Tasks\DeleteProductTypeTask;
use App\Containers\AppSection\ProductType\UI\API\Requests\DeleteProductTypeRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteProductTypeAction extends ParentAction
{

    public function run(DeleteProductTypeRequest $request)
    {
        return app(DeleteProductTypeTask::class)->run($request->id);
    }
}
