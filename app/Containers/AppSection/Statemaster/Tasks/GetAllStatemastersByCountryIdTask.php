<?php

namespace App\Containers\AppSection\Statemaster\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Statemaster\Data\Repositories\StatemasterRepository;
use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class GetAllStatemastersByCountryIdTask extends ParentTask
{
    use HashIdTrait;
    protected StatemasterRepository $repository;
    public function __construct(StatemasterRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($id)
    {
        try {
            $getData = Statemaster::where('country_id', $id)->where('is_active', 1)->get();

            $returnData = array();
            if (!empty($getData) && count($getData) >= 1) {
                $returnData['message'] = "Data Found";
                for ($i = 0; $i < count($getData); $i++) {
                    $returnData['data'][$i]['object'] = "mw_statemaster";
                    $returnData['data'][$i]['id'] = $this->encode($getData[$i]->id);
                    $returnData['data'][$i]['country_id'] = $this->encode($getData[$i]->country_id);
                    $returnData['data'][$i]['state'] = $getData[$i]->state;
                    $returnData['data'][$i]['is_active'] = $getData[$i]->is_active;
                    $returnData['data'][$i]['created_at'] = $getData[$i]->created_at;
                    $returnData['data'][$i]['updated_at'] = $getData[$i]->updated_at;
                }
            } else {

                $returnData['message'] = "Data Not Found";
                $returnData['object'] = "mw_statemaster";
            }
            return $returnData;
        } catch (Exception $e) {
            return [

                'message' => 'Error: Failed to get the resource. Please try again later.',
                'object' => 'mw_statemaster',
                'data' => [],
            ];
        }
    }
}
