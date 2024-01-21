<?php

namespace App\Containers\AppSection\Citymaster\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Citymaster\Data\Repositories\CitymasterRepository;
use App\Containers\AppSection\Citymaster\Models\Citymaster;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteCitymasterTask extends ParentTask
{
    use HashIdTrait;
    protected CitymasterRepository $repository;
    public function __construct(CitymasterRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($id)
    {
        try {
            $getData = Citymaster::where('id', $id)->first();
            if (!empty($getData)) {
                $delete_user = $this->repository->delete($id);
                $returnData['message'] = "Data Deleted Successfully";
                $returnData['object'] = "citymaster";
            } else {
                $returnData['message'] = "Data not Found";
                $returnData['object'] = "citymaster";
            }
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to delete the resource. Please try again later.',
                'object' => 'citymaster',
                'data' => [],
            ];
        }
    }
}
