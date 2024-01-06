<?php

namespace App\Containers\AppSection\Role\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Role\Models\Role;
use App\Containers\AppSection\Role\Tasks\UpdateRoleTask;
use App\Containers\AppSection\Role\UI\API\Requests\UpdateRoleRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateRoleAction extends ParentAction
{
    /**
     * @param UpdateRoleRequest $request
     * @return Role
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateRoleRequest $request): Role
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(UpdateRoleTask::class)->run($data, $request->id);
    }
}
