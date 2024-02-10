<?php

namespace App\Containers\AppSection\UserActivity\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\UserActivity\Actions\CreateUserActivityAction;
use App\Containers\AppSection\UserActivity\Actions\DeleteUserActivityAction;
use App\Containers\AppSection\UserActivity\Actions\FindUserActivityByIdAction;
use App\Containers\AppSection\UserActivity\Actions\GetAllUserActivitiesAction;
use App\Containers\AppSection\UserActivity\Actions\GetAllUserActivitiesBySearchAction;
use App\Containers\AppSection\UserActivity\Actions\UpdateUserActivityAction;
use App\Containers\AppSection\UserActivity\Entities\UserActivity;
use App\Containers\AppSection\UserActivity\UI\API\Requests\CreateUserActivityRequest;
use App\Containers\AppSection\UserActivity\UI\API\Requests\DeleteUserActivityRequest;
use App\Containers\AppSection\UserActivity\UI\API\Requests\FindUserActivityByIdRequest;
use App\Containers\AppSection\UserActivity\UI\API\Requests\GetAllUserActivitiesRequest;
use App\Containers\AppSection\UserActivity\UI\API\Requests\UpdateUserActivityRequest;
use App\Containers\AppSection\UserActivity\UI\API\Transformers\UserActivityTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{

    public function createUserActivity(CreateUserActivityRequest $request)
    {
        $InputData = new UserActivity($request);
        $useractivity = app(CreateUserActivityAction::class)->run($request, $InputData);
        return $useractivity;
    }

    /**
     * @param FindUserActivityByIdRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findUserActivityById(FindUserActivityByIdRequest $request): array
    {
        $useractivity = app(FindUserActivityByIdAction::class)->run($request);

        return $this->transform($useractivity, UserActivityTransformer::class);
    }

    /**
     * @param GetAllUserActivitiesRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllUserActivities(GetAllUserActivitiesRequest $request): array
    {
        $useractivities = app(GetAllUserActivitiesAction::class)->run($request);

        return $this->transform($useractivities, UserActivityTransformer::class);
    }

    public function getAllUserActivitiesBySearch(GetAllUserActivitiesRequest $request)
    {
        $InputData = new UserActivity($request);
        $useractivities = app(GetAllUserActivitiesBySearchAction::class)->run($request, $InputData);
        return $useractivities;
    }

    /**
     * @param UpdateUserActivityRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     */
    public function updateUserActivity(UpdateUserActivityRequest $request): array
    {
        $useractivity = app(UpdateUserActivityAction::class)->run($request);

        return $this->transform($useractivity, UserActivityTransformer::class);
    }

    /**
     * @param DeleteUserActivityRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     */
    public function deleteUserActivity(DeleteUserActivityRequest $request): JsonResponse
    {
        app(DeleteUserActivityAction::class)->run($request);

        return $this->noContent();
    }
}
