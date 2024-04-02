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
        if (Citymaster::where('id', '!=', $request->id)->where('city', $InputData->getCity())->whereNull('deleted_at')->count() == 0) {
            if ($InputData->getFlag() == "status") {
                $data = $request->sanitizeInput([
                    "is_active" => $InputData->getIsActive(),
                ]);
            } else {
                $data = $request->sanitizeInput([
                    "city" => $InputData->getCity(),
                ]);
                $data['country_id'] = $this->decode($InputData->getCountryId());
                $data['state_id'] = $this->decode($InputData->getStateId());
                $data = array_filter($data);
            }
        } else {
            $returnData['result'] = false;
            $returnData['message'] = "City Already Exists";
            $returnData['object'] = "citymaster";
            return $returnData;
        }



        return app(UpdateCitymasterTask::class)->run($data, $request->id);
    }
}
