<?php

namespace App\Containers\AppSection\Products\Actions;

use App\Containers\AppSection\Products\Models\Products;
use App\Containers\AppSection\Products\Tasks\FindProductsByIdTask;
use App\Containers\AppSection\Products\UI\API\Requests\FindProductsByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindProductsByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindProductsByIdRequest $request): Products
    {
        return app(FindProductsByIdTask::class)->run($request->id);
    }
}
