<?php

namespace App\Containers\AppSection\Statemaster\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Statemaster\Actions\CreateStatemasterAction;
use App\Containers\AppSection\Statemaster\Actions\DeleteStatemasterAction;
use App\Containers\AppSection\Statemaster\Actions\FindStatemasterByIdAction;
use App\Containers\AppSection\Statemaster\Actions\GetAllStatemastersBySearchAction;
use App\Containers\AppSection\Statemaster\Actions\GetAllStatemastersByCountryIdAction;
use App\Containers\AppSection\Statemaster\Actions\UpdateStatemasterAction;
use App\Containers\AppSection\Statemaster\Entities\Statemaster;
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

    public function createStatemaster(CreateStatemasterRequest $request)
    {
        $InputData = new Statemaster($request);
        $statemaster = app(CreateStatemasterAction::class)->run($request, $InputData);
        return $statemaster;
    }

    public function findStatemasterById(FindStatemasterByIdRequest $request)
    {
        $statemaster = app(FindStatemasterByIdAction::class)->run($request);
        return $statemaster;
    }


    public function getAllStatemastersBySearch(GetAllStatemastersRequest $request)
    {
        $InputData = new Statemaster($request);
        $statemasters = app(GetAllStatemastersBySearchAction::class)->run($request, $InputData);
        return $statemasters;
    }


    public function GetAllStatemastersByCountryId(FindStatemasterByIdRequest $request)
    {
        $statemasters = app(GetAllStatemastersByCountryIdAction::class)->run($request);
        return $statemasters;
    }


    public function updateStatemaster(UpdateStatemasterRequest $request)
    {
        $InputData = new Statemaster($request);
        $statemaster = app(UpdateStatemasterAction::class)->run($request, $InputData);
        return $statemaster;
    }


    public function deleteStatemaster(DeleteStatemasterRequest $request)
    {
        $statemaster =    app(DeleteStatemasterAction::class)->run($request);
        return $statemaster;
    }
}
