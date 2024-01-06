<?php

namespace App\Containers\AppSection\Role\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Role\Models\Role;
use App\Containers\AppSection\Role\Tasks\CreateRoleTask;
use App\Containers\AppSection\Role\UI\API\Requests\CreateRoleRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateRoleAction extends ParentAction
{
    /**
     * @param CreateRoleRequest $request
     * @return Role
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateRoleRequest $request): Role
    {
        $data = $request->sanitizeInput([
            // add your request data here
            'name' => $InputData->getName(),
        ]);


        return app(CreateRoleTask::class)->run($data);
    }
}
