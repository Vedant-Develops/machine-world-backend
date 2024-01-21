<?php

namespace App\Containers\AppSection\ProductType\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Products\Entities\Products;
use App\Containers\AppSection\ProductType\Actions\CreateProductTypeAction;
use App\Containers\AppSection\ProductType\Actions\DeleteProductTypeAction;
use App\Containers\AppSection\ProductType\Actions\FindProductTypeByIdAction;
use App\Containers\AppSection\ProductType\Actions\GetAllProductTypesAction;
use App\Containers\AppSection\ProductType\Actions\UpdateProductTypeStatusAction;
use App\Containers\AppSection\ProductType\Actions\UpdateProductTypeAction;
use App\Containers\AppSection\ProductType\UI\API\Requests\CreateProductTypeRequest;
use App\Containers\AppSection\ProductType\UI\API\Requests\DeleteProductTypeRequest;
use App\Containers\AppSection\ProductType\UI\API\Requests\FindProductTypeByIdRequest;
use App\Containers\AppSection\ProductType\UI\API\Requests\GetAllProductTypesRequest;
use App\Containers\AppSection\ProductType\UI\API\Requests\UpdateProductTypeRequest;
use App\Containers\AppSection\ProductType\UI\API\Transformers\ProductTypeTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{

    public function createProductType(CreateProductTypeRequest $request)
    {

        $InputData = new Products($request);
        $producttype = app(CreateProductTypeAction::class)->run($request, $InputData);
        return $producttype;
    }


    public function findProductTypeById(FindProductTypeByIdRequest $request)
    {
        $producttype = app(FindProductTypeByIdAction::class)->run($request);

        return $this->transform($producttype, ProductTypeTransformer::class);
    }


    public function getAllProductTypes(GetAllProductTypesRequest $request)
    {
        $producttypes = app(GetAllProductTypesAction::class)->run($request);

        return $this->transform($producttypes, ProductTypeTransformer::class);
    }


    public function updateProductType(UpdateProductTypeRequest $request)
    {

        $InputData = new Products($request);
        $producttype = app(UpdateProductTypeAction::class)->run($request, $InputData);
        return $producttype;
    }


    public function UpdateProductTypeStatus(UpdateProductTypeRequest $request)
    {
        $InputData = new Products($request);
        $producttype = app(UpdateProductTypeStatusAction::class)->run($request, $InputData);
        return $producttype;
    }


    public function deleteProductType(DeleteProductTypeRequest $request)
    {
        $producttype =    app(DeleteProductTypeAction::class)->run($request);
        return $producttype;
    }
}
