<?php

namespace App\Containers\AppSection\ProductType\Actions;

use App\Containers\AppSection\ProductType\Models\ProductType;
use App\Containers\AppSection\ProductType\Tasks\FindProductTypeByIdTask;
use App\Containers\AppSection\ProductType\UI\API\Requests\FindProductTypeByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindProductTypeByIdAction extends ParentAction
{

    public function run(FindProductTypeByIdRequest $request)
    {
        return app(FindProductTypeByIdTask::class)->run($request->id);
    }
}
