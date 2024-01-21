<?php

namespace App\Containers\AppSection\Statemaster\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Containers\AppSection\Statemaster\Tasks\CreateStatemasterTask;
use App\Containers\AppSection\Statemaster\UI\API\Requests\CreateStatemasterRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateStatemasterAction extends ParentAction
{
    /**
     * @param CreateStatemasterRequest $request
     * @return Statemaster
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateStatemasterRequest $request): Statemaster
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(CreateStatemasterTask::class)->run($data);
    }
}
