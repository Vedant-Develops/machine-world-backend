<?php

namespace App\Containers\AppSection\Citymaster\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Citymaster\Actions\CreateCitymasterAction;
use App\Containers\AppSection\Citymaster\Actions\DeleteCitymasterAction;
use App\Containers\AppSection\Citymaster\Actions\FindCitymasterByIdAction;
use App\Containers\AppSection\Citymaster\Actions\FindCitymasterByStateIdAction;
use App\Containers\AppSection\Citymaster\Actions\GetAllCitymastersAction;
use App\Containers\AppSection\Citymaster\Actions\GetAllCitymastersBySearchAction;
use App\Containers\AppSection\Citymaster\Actions\UpdateCitymasterAction;
use App\Containers\AppSection\Citymaster\Actions\UpdateCitymasterStatusAction;
use App\Containers\AppSection\Citymaster\Entities\Citymaster;
use App\Containers\AppSection\Citymaster\UI\API\Requests\CreateCitymasterRequest;
use App\Containers\AppSection\Citymaster\UI\API\Requests\DeleteCitymasterRequest;
use App\Containers\AppSection\Citymaster\UI\API\Requests\FindCitymasterByIdRequest;
use App\Containers\AppSection\Citymaster\UI\API\Requests\GetAllCitymastersRequest;
use App\Containers\AppSection\Citymaster\UI\API\Requests\UpdateCitymasterRequest;
use App\Containers\AppSection\Citymaster\UI\API\Transformers\CitymasterTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{

    public function createCitymaster(CreateCitymasterRequest $request)
    {
        $InputData = new Citymaster($request);
        $citymaster = app(CreateCitymasterAction::class)->run($request, $InputData);
        return $citymaster;
    }


    public function findCitymasterById(FindCitymasterByIdRequest $request)
    {
        $citymaster = app(FindCitymasterByIdAction::class)->run($request);
        return $citymaster;
    }

    public function FindCitymasterByStateId(FindCitymasterByIdRequest $request)
    {
        $citymaster = app(FindCitymasterByStateIdAction::class)->run($request);
        return $citymaster;
    }

    public function GetAllCitymastersBySearch(GetAllCitymastersRequest $request)
    {
        $InputData = new Citymaster($request);
        $citymasters = app(GetAllCitymastersBySearchAction::class)->run($request, $InputData);
        return $citymasters;
    }
    public function getAllCitymasters(GetAllCitymastersRequest $request)
    {
        $InputData = new Citymaster($request);
        $citymasters = app(GetAllCitymastersAction::class)->run($request, $InputData);
        return $citymasters;
    }

    public function updateCitymaster(UpdateCitymasterRequest $request)
    {
        $InputData = new Citymaster($request);
        $citymaster = app(UpdateCitymasterAction::class)->run($request, $InputData);
        return $citymaster;
    }

    public function UpdateCitymasterStatus(UpdateCitymasterRequest $request)
    {
        $citymaster = app(UpdateCitymasterStatusAction::class)->run($request);
        return $citymaster;
    }


    public function deleteCitymaster(DeleteCitymasterRequest $request)
    {
        $citymaster =  app(DeleteCitymasterAction::class)->run($request);
        return $citymaster;
    }
}
