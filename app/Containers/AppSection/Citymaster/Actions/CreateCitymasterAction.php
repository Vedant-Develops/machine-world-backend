<?php

namespace App\Containers\AppSection\Citymaster\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Citymaster\Models\Citymaster;
use App\Containers\AppSection\Citymaster\Tasks\CreateCitymasterTask;
use App\Containers\AppSection\Citymaster\UI\API\Requests\CreateCitymasterRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateCitymasterAction extends ParentAction
{
    use HashIdTrait;
    public function run(CreateCitymasterRequest $request, $InputData)
    {
        $state_id = $this->decode($InputData->getStateId());
        $country_id = $this->decode($InputData->getCountryId());
        $data = [];

        if (Citymaster::where('city', $InputData->getCity())->whereNull('deleted_at')->count() == 0) {
            $data = $request->sanitizeInput([
                //"country_id" => $country_id,
                //  "state_id" => $state_id,
                "city" => $InputData->getCity(),
                "is_active" => 1
            ]);
            $data['country_id'] = $country_id;
            $data['state_id'] = $state_id;
        } else {
            $returnData['result'] = false;
            $returnData['message'] = "City Already Exists";
            $returnData['object'] = "citymaster";
            return $returnData;
        }


        return app(CreateCitymasterTask::class)->run($data);
    }
}
