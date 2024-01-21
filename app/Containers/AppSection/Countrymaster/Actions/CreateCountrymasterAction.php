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
    /**
     * @param CreateCountrymasterRequest $request
     * @return Countrymaster
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateCountrymasterRequest $request): Countrymaster
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(CreateCountrymasterTask::class)->run($data);
    }
}
