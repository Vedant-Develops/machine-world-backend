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
    /**
     * @param UpdateCountrymasterRequest $request
     * @return Countrymaster
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateCountrymasterRequest $request): Countrymaster
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(UpdateCountrymasterTask::class)->run($data, $request->id);
    }
}
