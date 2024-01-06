<?php

namespace App\Containers\AppSection\Role\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Role\Actions\CreateRoleAction;
use App\Containers\AppSection\Role\Actions\DeleteRoleAction;
use App\Containers\AppSection\Role\Actions\FindRoleByIdAction;
use App\Containers\AppSection\Role\Actions\GetAllRolesAction;
use App\Containers\AppSection\Role\Actions\UpdateRoleAction;
use App\Containers\AppSection\Role\UI\API\Requests\CreateRoleRequest;
use App\Containers\AppSection\Role\UI\API\Requests\DeleteRoleRequest;
use App\Containers\AppSection\Role\UI\API\Requests\FindRoleByIdRequest;
use App\Containers\AppSection\Role\UI\API\Requests\GetAllRolesRequest;
use App\Containers\AppSection\Role\UI\API\Requests\UpdateRoleRequest;
use App\Containers\AppSection\Role\UI\API\Transformers\RoleTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{
    /**
     * @param CreateRoleRequest $request
     * @return JsonResponse
     * @throws InvalidTransformerException
     * @throws CreateResourceFailedException
     */
    public function createRole(CreateRoleRequest $request): JsonResponse
    {
        $role = app(CreateRoleAction::class)->run($request);

        return $this->created($this->transform($role, RoleTransformer::class));
    }

    /**
     * @param FindRoleByIdRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findRoleById(FindRoleByIdRequest $request): array
    {
        $role = app(FindRoleByIdAction::class)->run($request);

        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @param GetAllRolesRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllRoles(GetAllRolesRequest $request): array
    {
        $roles = app(GetAllRolesAction::class)->run($request);

        return $this->transform($roles, RoleTransformer::class);
    }

    /**
     * @param UpdateRoleRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     */
    public function updateRole(UpdateRoleRequest $request): array
    {
        $role = app(UpdateRoleAction::class)->run($request);

        return $this->transform($role, RoleTransformer::class);
    }

    /**
     * @param DeleteRoleRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     */
    public function deleteRole(DeleteRoleRequest $request): JsonResponse
    {
        app(DeleteRoleAction::class)->run($request);

        return $this->noContent();
    }
}
