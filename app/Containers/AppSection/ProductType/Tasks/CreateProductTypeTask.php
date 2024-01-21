<?php

namespace App\Containers\AppSection\ProductType\Tasks;

use App\Containers\AppSection\ProductType\Data\Repositories\ProductTypeRepository;
use App\Containers\AppSection\ProductType\Models\ProductType;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateProductTypeTask extends ParentTask
{
    protected ProductTypeRepository $repository;
    public function __construct(ProductTypeRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($data)
    {

        try {
            $data = $this->repository->create($data);
            $response['data'] = [
                "object" => $data->getResourceKey(),
                'id' => $data->getHashedKey(),
                "type" => $data->type,
                "is_active" => $data->is_active,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
            ];
            return $response;
        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}
