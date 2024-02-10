<?php

namespace App\Containers\AppSection\Countrymaster\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Countrymaster\Models\Countrymaster;
use App\Containers\AppSection\Countrymaster\Tasks\UpdateCountrymasterTask;
use App\Containers\AppSection\Countrymaster\UI\API\Requests\UpdateCountrymasterRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateCountrymasterAction extends ParentAction
{

    public function run(UpdateCountrymasterRequest $request, $InputData)
    {
        $data = [];
        if (Countrymaster::where('id', '!=', $request->id)->where('country', $InputData->getCountry())->whereNull('deleted_at')->count() == 0) {
            if ($InputData->getFlag() == "status") {
                $data = $request->sanitizeInput([
                    "is_active" => $InputData->getIsActive(),
                ]);
            } else {
                $data = $request->sanitizeInput([
                    "country" => $InputData->getCountry(),
                ]);
            }
        } else {
            $returnData['result'] = false;
            $returnData['message'] = "Country Already Exists";
            $returnData['object'] = "countrymaster";
            return $returnData;
        }

        return app(UpdateCountrymasterTask::class)->run($data, $request->id);
    }
}
