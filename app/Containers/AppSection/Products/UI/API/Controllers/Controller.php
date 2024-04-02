<?php

namespace App\Containers\AppSection\Products\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Products\Actions\CreateProductsAction;
use App\Containers\AppSection\Products\Actions\DeleteProductsAction;
use App\Containers\AppSection\Products\Actions\FindProductsByIdAction;
use App\Containers\AppSection\Products\Actions\GetAllProductsAction;
use App\Containers\AppSection\Products\Actions\GetAllProductsBySearchAction;
use App\Containers\AppSection\Products\Actions\UpdateProductsAction;
use App\Containers\AppSection\Products\Actions\UpdateProductsByFieldAction;
use App\Containers\AppSection\Products\Entities\Products;
use App\Containers\AppSection\Products\UI\API\Requests\CreateProductsRequest;
use App\Containers\AppSection\Products\UI\API\Requests\DeleteProductsRequest;
use App\Containers\AppSection\Products\UI\API\Requests\FindProductsByIdRequest;
use App\Containers\AppSection\Products\UI\API\Requests\GetAllProductsRequest;
use App\Containers\AppSection\Products\UI\API\Requests\UpdateProductsRequest;
use App\Containers\AppSection\Products\UI\API\Transformers\ProductsTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{

    public function createProducts(CreateProductsRequest $request)
    {
        $InputData = new Products($request);
        $products = app(CreateProductsAction::class)->run($request, $InputData);
        return $products;
    }


    public function findProductsById(FindProductsByIdRequest $request)
    {
        $products = app(FindProductsByIdAction::class)->run($request);
        return $this->transform($products, ProductsTransformer::class);
    }


    public function getAllProducts(GetAllProductsRequest $request)
    {
        $products = app(GetAllProductsAction::class)->run($request);
        return $products;
    }


    public function GetAllProductsBySearch(GetAllProductsRequest $request)
    {
        $InputData = new Products($request);
        $products = app(GetAllProductsBySearchAction::class)->run($request, $InputData);
        return $products;
    }


    public function updateProducts(UpdateProductsRequest $request)
    {
        $InputData = new Products($request);
        $products = app(UpdateProductsAction::class)->run($request, $InputData);
        return $products;
    }

    public function UpdateProductsByField(UpdateProductsRequest $request)
    {
        $InputData = new Products($request);
        $products = app(UpdateProductsByFieldAction::class)->run($request, $InputData);
        return $products;
    }

    public function deleteProducts(DeleteProductsRequest $request)
    {
        $products = app(DeleteProductsAction::class)->run($request);
        return $products;
    }
}
