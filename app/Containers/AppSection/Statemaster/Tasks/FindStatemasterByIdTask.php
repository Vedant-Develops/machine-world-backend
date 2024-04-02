<?php

namespace App\Containers\AppSection\Statemaster\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Statemaster\Data\Repositories\StatemasterRepository;
use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindStatemasterByIdTask extends ParentTask
{
    use HashIdTrait;
    public function __construct(
        protected StatemasterRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id)
    {
        try {
            $getData = Statemaster::where('id', $id)->first();
            $returnData = array();
            if (!empty($getData)) {
                $returnData['message'] = "Data Found";
                $returnData['object'] = "mw_statemaster";
                $returnData['data']['id'] = $this->encode($getData->id);
                $returnData['data']['country_id'] =  $this->encode($getData->country_id);
                $returnData['data']['state'] = $getData->state;
                $returnData['data']['is_active'] = $getData->is_active;
                $returnData['data']['created_at'] = $getData->created_at;
                $returnData['data']['updated_at'] = $getData->updated_at;
            } else {
                $returnData['message'] = "Data Not Found";
                $returnData['object'] = "mw_statemaster";
            }
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to Find the resource. Please try again later.',
                'object' => 'mw_statemaster',
                'data' => [],
            ];
        }
    }
}
