<?php

namespace App\Containers\AppSection\ProductType\Tasks;

use App\Containers\AppSection\ProductType\Data\Repositories\ProductTypeRepository;
use App\Containers\AppSection\ProductType\Models\ProductType;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateProductTypeTask extends ParentTask
{
    protected ProductTypeRepository $repository;
    public function __construct(ProductTypeRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($data, $id)
    {
        try {
            $update = $this->repository->update($data, $id);

            $response['data'] = [
                "object" => $update->getResourceKey(),
                'id' => $update->getHashedKey(),
                "type" => $update->type,
                "is_active" => $update->is_active,
                'created_at' => $update->created_at,
                'updated_at' => $update->updated_at,
            ];
            return $response;
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
