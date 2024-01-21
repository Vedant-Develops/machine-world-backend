<?php

namespace App\Containers\AppSection\Citymaster\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Citymaster\Data\Repositories\CitymasterRepository;
use App\Containers\AppSection\Citymaster\Models\Citymaster;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateCitymasterTask extends ParentTask
{
    use HashIdTrait;
    protected CitymasterRepository $repository;
    public function __construct(CitymasterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            $createData = Citymaster::create($data);
            $getData = Citymaster::where('id', $createData->id)->first();
            $returnData = array();
            if (!empty($getData)) {
                $returnData['message'] = "Data Created";
                $returnData['object'] = "citymaster";
                $returnData['data']['id'] = $this->encode($getData->id);
                $returnData['data']['country_id'] =  $this->encode($getData->country_id);
                $returnData['data']['state_id'] = $this->encode($getData->state_id);
                $returnData['data']['city'] = $getData->city;
                $returnData['data']['is_active'] = $getData->is_active;
                $returnData['data']['created_at'] = $getData->created_at;
                $returnData['data']['updated_at'] = $getData->updated_at;
            } else {
                $returnData['message'] = "Data Not Found";
                $returnData['object'] = "citymaster";
            }
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to create the resource. Please try again later.',
                'object' => 'citymaster',
                'data' => [],
            ];
        }
    }
}
