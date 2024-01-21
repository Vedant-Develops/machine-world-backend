<?php

namespace App\Containers\AppSection\ProductType\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\ProductType\Models\ProductType;
use App\Containers\AppSection\ProductType\Tasks\UpdateProductTypeTask;
use App\Containers\AppSection\ProductType\UI\API\Requests\UpdateProductTypeRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateProductTypeAction extends ParentAction
{

    public function run(UpdateProductTypeRequest $request, $InputData)
    {
        $check_product_type = ProductType::where('id', '!=', $request->id)->where('type', $InputData->getType())->count();

        if ($check_product_type == 0) {
            $data = $request->sanitizeInput([
                "type" => $InputData->getType(),
            ]);
        } else {
            $returnData['message'] = "Product Type exists";
            return $returnData;
        }


        return app(UpdateProductTypeTask::class)->run($data, $request->id);
    }
}
