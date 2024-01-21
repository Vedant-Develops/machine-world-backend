<?php

namespace App\Containers\AppSection\Citymaster\Actions;

use App\Containers\AppSection\Citymaster\Models\Citymaster;
use App\Containers\AppSection\Citymaster\Tasks\FindCitymasterByStateIdTask;
use App\Containers\AppSection\Citymaster\UI\API\Requests\FindCitymasterByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindCitymasterByStateIdAction extends ParentAction
{

    public function run(FindCitymasterByIdRequest $request)
    {
        return app(FindCitymasterByStateIdTask::class)->run($request->id);
    }
}
