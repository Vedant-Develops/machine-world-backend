<?php

namespace App\Containers\AppSection\Countrymaster\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Countrymaster\Actions\CreateCountrymasterAction;
use App\Containers\AppSection\Countrymaster\Actions\DeleteCountrymasterAction;
use App\Containers\AppSection\Countrymaster\Actions\FindCountrymasterByIdAction;
use App\Containers\AppSection\Countrymaster\Actions\GetAllCountrymastersAction;
use App\Containers\AppSection\Countrymaster\Actions\UpdateCountrymasterAction;
use App\Containers\AppSection\Countrymaster\Actions\GetAllCountrymastersBySearchAction;
use App\Containers\AppSection\Countrymaster\Entities\Countrymaster;
use App\Containers\AppSection\Countrymaster\UI\API\Requests\CreateCountrymasterRequest;
use App\Containers\AppSection\Countrymaster\UI\API\Requests\DeleteCountrymasterRequest;
use App\Containers\AppSection\Countrymaster\UI\API\Requests\FindCountrymasterByIdRequest;
use App\Containers\AppSection\Countrymaster\UI\API\Requests\GetAllCountrymastersRequest;
use App\Containers\AppSection\Countrymaster\UI\API\Requests\UpdateCountrymasterRequest;
use App\Containers\AppSection\Countrymaster\UI\API\Transformers\CountrymasterTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{

    public function createCountrymaster(CreateCountrymasterRequest $request)
    {
        $InputData = new Countrymaster($request);
        $countrymaster = app(CreateCountrymasterAction::class)->run($request, $InputData);
        return $countrymaster;
    }


    public function findCountrymasterById(FindCountrymasterByIdRequest $request)
    {
        $countrymaster = app(FindCountrymasterByIdAction::class)->run($request);
        return $countrymaster;
    }


    public function getAllCountrymasters(GetAllCountrymastersRequest $request)
    {
        $countrymasters = app(GetAllCountrymastersAction::class)->run($request);
        return $countrymasters;
    }

    public function getAllCountrymastersBySearch(GetAllCountrymastersRequest $request)
    {

        $InputData = new Countrymaster($request);
        $countrymasters = app(GetAllCountrymastersBySearchAction::class)->run($request, $InputData);
        return $countrymasters;
    }

    public function updateCountrymaster(UpdateCountrymasterRequest $request)
    {

        $InputData = new Countrymaster($request);
        $countrymaster = app(UpdateCountrymasterAction::class)->run($request, $InputData);
        return $countrymaster;
    }




    public function deleteCountrymaster(DeleteCountrymasterRequest $request)
    {
        $countrymaster = app(DeleteCountrymasterAction::class)->run($request);

        return $countrymaster;
    }
}
