<?php

namespace App\Containers\AppSection\Countrymaster\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Countrymaster\Actions\CreateCountrymasterAction;
use App\Containers\AppSection\Countrymaster\Actions\DeleteCountrymasterAction;
use App\Containers\AppSection\Countrymaster\Actions\FindCountrymasterByIdAction;
use App\Containers\AppSection\Countrymaster\Actions\GetAllCountrymastersAction;
use App\Containers\AppSection\Countrymaster\Actions\UpdateCountrymasterAction;
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
    /**
     * @param CreateCountrymasterRequest $request
     * @return JsonResponse
     * @throws InvalidTransformerException
     * @throws CreateResourceFailedException
     */
    public function createCountrymaster(CreateCountrymasterRequest $request): JsonResponse
    {
        $countrymaster = app(CreateCountrymasterAction::class)->run($request);

        return $this->created($this->transform($countrymaster, CountrymasterTransformer::class));
    }

    /**
     * @param FindCountrymasterByIdRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findCountrymasterById(FindCountrymasterByIdRequest $request): array
    {
        $countrymaster = app(FindCountrymasterByIdAction::class)->run($request);

        return $this->transform($countrymaster, CountrymasterTransformer::class);
    }


    public function getAllCountrymasters(GetAllCountrymastersRequest $request)
    {
        $countrymasters = app(GetAllCountrymastersAction::class)->run($request);
        return $countrymasters;
    }

    /**
     * @param UpdateCountrymasterRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     */
    public function updateCountrymaster(UpdateCountrymasterRequest $request): array
    {
        $countrymaster = app(UpdateCountrymasterAction::class)->run($request);

        return $this->transform($countrymaster, CountrymasterTransformer::class);
    }

    /**
     * @param DeleteCountrymasterRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     */
    public function deleteCountrymaster(DeleteCountrymasterRequest $request): JsonResponse
    {
        app(DeleteCountrymasterAction::class)->run($request);

        return $this->noContent();
    }
}
