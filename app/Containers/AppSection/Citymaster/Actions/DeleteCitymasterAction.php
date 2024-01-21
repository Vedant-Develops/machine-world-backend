<?php

namespace App\Containers\AppSection\Citymaster\Actions;

use App\Containers\AppSection\Citymaster\Tasks\DeleteCitymasterTask;
use App\Containers\AppSection\Citymaster\UI\API\Requests\DeleteCitymasterRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteCitymasterAction extends ParentAction
{
    public function run(DeleteCitymasterRequest $request)
    {
        return app(DeleteCitymasterTask::class)->run($request->id);
    }
}
