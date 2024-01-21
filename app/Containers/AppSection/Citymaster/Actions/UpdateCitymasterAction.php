<?php

namespace App\Containers\AppSection\Citymaster\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Citymaster\Models\Citymaster;
use App\Containers\AppSection\Citymaster\Tasks\UpdateCitymasterTask;
use App\Containers\AppSection\Citymaster\UI\API\Requests\UpdateCitymasterRequest;
use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateCitymasterAction extends ParentAction
{
    use HashIdTrait;
    public function run(UpdateCitymasterRequest $request, $InputData)
    {
        $data = [];
        if (Citymaster::where('city', $InputData->getCity())->exists() == 0) {
            $data = $request->sanitizeInput([
                "city" => $InputData->getCity(),
            ]);
        } else {
            $returnData['result'] = false;
            $returnData['message'] = "City Already Exists";
            $returnData['object'] = "citymaster";
            return $returnData;
        }


        return app(UpdateCitymasterTask::class)->run($data, $request->id);
    }
}
