<?php

namespace App\Containers\AppSection\Statemaster\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Statemaster\Actions\CreateStatemasterAction;
use App\Containers\AppSection\Statemaster\Actions\DeleteStatemasterAction;
use App\Containers\AppSection\Statemaster\Actions\FindStatemasterByIdAction;
use App\Containers\AppSection\Statemaster\Actions\GetAllStatemastersAction;
use App\Containers\AppSection\Statemaster\Actions\GetAllStatemastersByCountryIdAction;
use App\Containers\AppSection\Statemaster\Actions\UpdateStatemasterAction;
use App\Containers\AppSection\Statemaster\UI\API\Requests\CreateStatemasterRequest;
use App\Containers\AppSection\Statemaster\UI\API\Requests\DeleteStatemasterRequest;
use App\Containers\AppSection\Statemaster\UI\API\Requests\FindStatemasterByIdRequest;
use App\Containers\AppSection\Statemaster\UI\API\Requests\GetAllStatemastersRequest;
use App\Containers\AppSection\Statemaster\UI\API\Requests\UpdateStatemasterRequest;
use App\Containers\AppSection\Statemaster\UI\API\Transformers\StatemasterTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{

    public function createStatemaster(CreateStatemasterRequest $request): JsonResponse
    {
        $statemaster = app(CreateStatemasterAction::class)->run($request);

        return $this->created($this->transform($statemaster, StatemasterTransformer::class));
    }

    /**
     * @param FindStatemasterByIdRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findStatemasterById(FindStatemasterByIdRequest $request): array
    {
        $statemaster = app(FindStatemasterByIdAction::class)->run($request);

        return $this->transform($statemaster, StatemasterTransformer::class);
    }

    /**
     * @param GetAllStatemastersRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllStatemasters(GetAllStatemastersRequest $request): array
    {
        $statemasters = app(GetAllStatemastersAction::class)->run($request);

        return $this->transform($statemasters, StatemasterTransformer::class);
    }


    public function GetAllStatemastersByCountryId(FindStatemasterByIdRequest $request)
    {
        $statemasters = app(GetAllStatemastersByCountryIdAction::class)->run($request);
        return $statemasters;
    }

    /**
     * @param UpdateStatemasterRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     */
    public function updateStatemaster(UpdateStatemasterRequest $request): array
    {
        $statemaster = app(UpdateStatemasterAction::class)->run($request);

        return $this->transform($statemaster, StatemasterTransformer::class);
    }

    /**
     * @param DeleteStatemasterRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     */
    public function deleteStatemaster(DeleteStatemasterRequest $request): JsonResponse
    {
        app(DeleteStatemasterAction::class)->run($request);

        return $this->noContent();
    }
}
