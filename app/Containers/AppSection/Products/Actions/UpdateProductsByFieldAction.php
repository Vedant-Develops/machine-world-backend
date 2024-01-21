<?php

namespace App\Containers\AppSection\Products\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Products\Models\Products;
use App\Containers\AppSection\Products\Tasks\UpdateProductsByFieldTask;
use App\Containers\AppSection\Products\UI\API\Requests\UpdateProductsRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateProductsByFieldAction extends ParentAction
{

    public function run(UpdateProductsRequest $request, $InputData)
    {

        return app(UpdateProductsByFieldTask::class)->run($request->id, $InputData);
    }
}
