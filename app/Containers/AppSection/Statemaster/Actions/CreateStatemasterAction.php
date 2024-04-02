<?php

namespace App\Containers\AppSection\Statemaster\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Containers\AppSection\Statemaster\Tasks\CreateStatemasterTask;
use App\Containers\AppSection\Statemaster\UI\API\Requests\CreateStatemasterRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateStatemasterAction extends ParentAction
{
    use HashIdTrait;
    public function run(CreateStatemasterRequest $request, $InputData)
    {
        $data = [];
        if (Statemaster::where('state', $InputData->getState())->whereNull('deleted_at')->count() == 0) {
            $data = $request->sanitizeInput([
                "state" => $InputData->getState(),
                "is_active" => 1
            ]);
            $data['country_id'] = $this->decode($InputData->getCountryId());
        } else {
            $returnData['result'] = false;
            $returnData['message'] = "State Already Exists";
            $returnData['object'] = "statemaster";
            return $returnData;
        }


        return app(CreateStatemasterTask::class)->run($data);
    }
}
