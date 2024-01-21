<?php

namespace App\Containers\AppSection\Citymaster\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Citymaster\Data\Repositories\CitymasterRepository;
use App\Containers\AppSection\Citymaster\Models\Citymaster;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindCitymasterByStateIdTask extends ParentTask
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
            $getData = Citymaster::where('state_id', $id)->get();
            $returnData = array();
            if (!empty($getData) && count($getData) >= 1) {
                $returnData['message'] = "Data Found";
                for ($i = 0; $i < count($getData); $i++) {
                    $returnData['data'][$i]['object'] = "mw_citymaster";
                    $returnData['data'][$i]['id'] = $this->encode($getData[$i]->id);
                    $returnData['data'][$i]['country_id'] =  $this->encode($getData[$i]->country_id);
                    $returnData['data'][$i]['state_id'] = $this->encode($getData[$i]->state_id);
                    $returnData['data'][$i]['city'] = $getData[$i]->city;
                    $returnData['data'][$i]['is_active'] = $getData[$i]->is_active;
                    $returnData['data'][$i]['created_at'] = $getData[$i]->created_at;
                    $returnData['data'][$i]['updated_at'] = $getData[$i]->updated_at;
                }
            } else {
                $returnData['message'] = "Data Not Found";
                $returnData['object'] = "mw_citymaster";
            }
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to Find the resource. Please try again later.',
                'object' => 'mw_citymaster',
                'data' => [],
            ];
        }
    }
}
