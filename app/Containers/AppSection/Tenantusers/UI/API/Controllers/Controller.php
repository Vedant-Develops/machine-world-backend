<?php

namespace App\Containers\AppSection\Tenantusers\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Tenantusers\Actions\CreateTenantusersAction;
use App\Containers\AppSection\Tenantusers\Actions\DeleteTenantusersAction;
use App\Containers\AppSection\Tenantusers\Actions\FindTenantusersByIdAction;
use App\Containers\AppSection\Tenantusers\Actions\GetAllTenantusersAction;
use App\Containers\AppSection\Tenantusers\Actions\UpdateTenantusersByFieldsAction;
use App\Containers\AppSection\Tenantusers\Actions\UpdateTenantusersPasswordAction;
use App\Containers\AppSection\Tenantusers\Actions\UpdateTenantusersAction;
use App\Containers\AppSection\Tenantusers\Actions\ResetTenantusersPasswordAction;
use App\Containers\AppSection\Tenantusers\Entities\Tenantusers;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\CreateTenantusersRequest;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\DeleteTenantusersRequest;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\FindTenantusersByIdRequest;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\GetAllTenantusersRequest;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\UpdateTenantusersRequest;
use App\Containers\AppSection\Tenantusers\UI\API\Transformers\TenantusersTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{

    public function createTenantusers(CreateTenantusersRequest $request)
    {
        $InputData = new Tenantusers(
            $request
        );
        $tenantusers = app(CreateTenantusersAction::class)->run($request, $InputData);
        return $tenantusers;
    }


    public function findTenantusersById(FindTenantusersByIdRequest $request)
    {
        $tenantusers = app(FindTenantusersByIdAction::class)->run($request);
        return $tenantusers;
    }


    public function getAllTenantusers(GetAllTenantusersRequest $request)
    {
        $InputData = new Tenantusers($request);
        $tenantusers = app(GetAllTenantusersAction::class)->run($request, $InputData);
        return $tenantusers;
    }


    public function updateTenantusers(UpdateTenantusersRequest $request)
    {
        $InputData = new Tenantusers(
            $request
        );
        $tenantusers = app(UpdateTenantusersAction::class)->run($request, $InputData);
        return $tenantusers;
    }

    public function UpdateTenantusersByFields(UpdateTenantusersRequest $request)
    {
        $InputData = new Tenantusers(
            $request
        );
        $tenantusers = app(UpdateTenantusersByFieldsAction::class)->run($request, $InputData);
        return $tenantusers;
    }

    public function updateTenantusersPassword(UpdateTenantusersRequest $request)
    {
        $InputData = new Tenantusers(
            $request
        );
        $returnData = app(UpdateTenantusersPasswordAction::class)->run($request, $InputData);
        return $returnData;
    }

    public function resetTenantusersPassword(CreateTenantusersRequest $request)
    {
        $InputData = new Tenantusers($request);
        $returnData = app(ResetTenantusersPasswordAction::class)->run($request, $InputData);
        return $returnData;
    }


    public function deleteTenantusers(DeleteTenantusersRequest $request)
    {
        $returnData =  app(DeleteTenantusersAction::class)->run($request);
        return $returnData;
    }
}
