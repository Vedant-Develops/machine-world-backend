<?php

namespace App\Containers\AppSection\Citymaster\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Citymaster\Data\Repositories\CitymasterRepository;
use App\Containers\AppSection\Citymaster\Models\Citymaster;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindCitymasterByIdTask extends ParentTask
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
            $returnData = array();
            if (!empty($getData)) {
                $returnData['message'] = "Data Found";
                $returnData['data']['object'] = "citymaster";
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
                'result' => false,
                'message' => 'Error: Failed to Find the resource. Please try again later.',
                'object' => 'citymaster',
                'data' => [],
            ];
        }
    }
}
