<?php

namespace App\Containers\AppSection\Countrymaster\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Countrymaster\Models\Countrymaster;
use App\Containers\AppSection\Countrymaster\Tasks\CreateCountrymasterTask;
use App\Containers\AppSection\Countrymaster\UI\API\Requests\CreateCountrymasterRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateCountrymasterAction extends ParentAction
{

    public function run(CreateCountrymasterRequest $request, $InputData)
    {
        $data = [];
        if (Countrymaster::where('country', $InputData->getCountry())->whereNull('deleted_at')->count() == 0) {
            $data = $request->sanitizeInput([
                "country" => $InputData->getCountry(),
                "is_active" => 1
            ]);
        } else {
            $returnData['result'] = false;
            $returnData['message'] = "Country Already Exists";
            $returnData['object'] = "countrymaster";
            return $returnData;
        }

        return app(CreateCountrymasterTask::class)->run($data);
    }
}
