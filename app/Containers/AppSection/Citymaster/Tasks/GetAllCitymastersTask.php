<?php

namespace App\Containers\AppSection\Citymaster\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Citymaster\Data\Repositories\CitymasterRepository;
use App\Containers\AppSection\Citymaster\Models\Citymaster;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllCitymastersTask extends ParentTask
{
    use HashIdTrait;
    protected CitymasterRepository $repository;
    public function __construct(CitymasterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        try {
            $getData = Citymaster::where('is_active', 1)->get();
            $returnData = array();
            if (!empty($getData) && count($getData) >= 1) {
                $returnData['message'] = "Data Found";
                for ($i = 0; $i < count($getData); $i++) {
                    $returnData['data'][$i]['object'] = "citymaster";
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
                $returnData['object'] = "citymaster";
            }
            return $returnData;
        } catch (Exception $e) {
            return [

                'message' => 'Error: Failed to get the resource. Please try again later.',
                'object' => 'citymaster',
                'data' => [],
            ];
        }
    }
}
