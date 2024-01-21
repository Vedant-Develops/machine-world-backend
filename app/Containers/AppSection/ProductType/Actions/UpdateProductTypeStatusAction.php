<?php

namespace App\Containers\AppSection\ProductType\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\ProductType\Models\ProductType;
use App\Containers\AppSection\ProductType\Tasks\UpdateProductTypeStatusTask;
use App\Containers\AppSection\ProductType\UI\API\Requests\UpdateProductTypeRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateProductTypeStatusAction extends ParentAction
{

    public function run(UpdateProductTypeRequest $request, $InputData)
    {

        return app(UpdateProductTypeStatusTask::class)->run($InputData, $request->id);
    }
}
