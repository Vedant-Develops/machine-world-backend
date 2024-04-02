<?php

namespace App\Containers\AppSection\Statemaster\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Containers\AppSection\Statemaster\Tasks\UpdateStatemasterTask;
use App\Containers\AppSection\Statemaster\UI\API\Requests\UpdateStatemasterRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateStatemasterAction extends ParentAction
{
    use HashIdTrait;
    public function run(UpdateStatemasterRequest $request, $InputData)
    {
        $data = [];

        if (Statemaster::where('id', '!=', $request->id)->where('state', $InputData->getState())->whereNull('deleted_at')->count() == 0) {
            if ($InputData->getFlag() == "status") {
                $data = $request->sanitizeInput([
                    "is_active" => $InputData->getIsActive(),
                ]);
            } else {
                $data = $request->sanitizeInput([
                    "state" => $InputData->getState(),
                ]);
                $data['country_id'] = $this->decode($InputData->getCountryId());
                $data = array_filter($data);
            }
        } else {
            $returnData['result'] = false;
            $returnData['message'] = "State Already Exists";
            $returnData['object'] = "statemaster";
            return $returnData;
        }

        return app(UpdateStatemasterTask::class)->run($data, $request->id);
    }
}
