<?php

namespace App\Containers\AppSection\Statemaster\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Containers\AppSection\Statemaster\Tasks\UpdateStatemasterTask;
use App\Containers\AppSection\Statemaster\UI\API\Requests\UpdateStatemasterRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateStatemasterAction extends ParentAction
{
    /**
     * @param UpdateStatemasterRequest $request
     * @return Statemaster
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateStatemasterRequest $request): Statemaster
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(UpdateStatemasterTask::class)->run($data, $request->id);
    }
}
