<?php

namespace App\Containers\AppSection\Citymaster\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Citymaster\Models\Citymaster;
use App\Containers\AppSection\Citymaster\Tasks\UpdateCitymasterStatusTask;
use App\Containers\AppSection\Citymaster\UI\API\Requests\UpdateCitymasterRequest;
use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateCitymasterStatusAction extends ParentAction
{
    use HashIdTrait;
    public function run(UpdateCitymasterRequest $request, $InputData)
    {
        $returnData = array();
        $is_active = $InputData->getIsActive();
        $state_id = Citymaster::select('state_id')->where('id', $request->id)->first();
        $check_state = Statemaster::select('is_active')->where('id', $state_id->state_id)->first();
        if ($check_state->is_active ==  1) {

            if (!empty($is_active) && ($is_active == 1 || $is_active == 0)) {
                $data = $request->sanitizeInput([
                    "is_active" => $InputData->getIsActive(),
                ]);
            } else {
                $data = $request->sanitizeInput([
                    "is_active" => 0
                ]);
            }
        } else {
            $returnData['result'] = false;
            $returnData['message'] = "Please ensure that the state is set to 'Active' for this operation to proceed.";
            return $returnData;
        }

        return app(UpdateCitymasterStatusTask::class)->run($data, $request->id);
    }
}
