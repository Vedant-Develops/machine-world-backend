<?php

namespace App\Containers\AppSection\ProductType\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\ProductType\Models\ProductType;
use App\Containers\AppSection\ProductType\Tasks\CreateProductTypeTask;
use App\Containers\AppSection\ProductType\UI\API\Requests\CreateProductTypeRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateProductTypeAction extends ParentAction
{

    public function run(CreateProductTypeRequest $request, $InputData)
    {

        $check_product_type = ProductType::where('type', $InputData->getType())->count();

        if ($check_product_type == 0) {
            $data = $request->sanitizeInput([
                "type" => $InputData->getType(),
                "is_active" => 1
            ]);
        } else {
            $returnData['message'] = " Product Type exists";
            return $returnData;
        }


        return app(CreateProductTypeTask::class)->run($data);
    }
}
