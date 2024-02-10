<?php

namespace App\Containers\AppSection\Countrymaster\Actions;

use App\Containers\AppSection\Countrymaster\Models\Countrymaster;
use App\Containers\AppSection\Countrymaster\Tasks\FindCountrymasterByIdTask;
use App\Containers\AppSection\Countrymaster\UI\API\Requests\FindCountrymasterByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindCountrymasterByIdAction extends ParentAction
{

    public function run(FindCountrymasterByIdRequest $request)
    {
        return app(FindCountrymasterByIdTask::class)->run($request->id);
    }
}
