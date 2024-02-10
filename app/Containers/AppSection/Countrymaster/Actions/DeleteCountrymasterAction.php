<?php

namespace App\Containers\AppSection\Countrymaster\Actions;

use App\Containers\AppSection\Countrymaster\Tasks\DeleteCountrymasterTask;
use App\Containers\AppSection\Countrymaster\UI\API\Requests\DeleteCountrymasterRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteCountrymasterAction extends ParentAction
{

    public function run(DeleteCountrymasterRequest $request)
    {
        return app(DeleteCountrymasterTask::class)->run($request->id);
    }
}
