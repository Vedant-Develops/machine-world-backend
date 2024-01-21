<?php

namespace App\Containers\AppSection\Citymaster\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Citymaster\Data\Repositories\CitymasterRepository;
use App\Containers\AppSection\Citymaster\Models\Citymaster;
use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllCitymastersBySearchTask extends ParentTask
{
    use HashIdTrait;
    protected CitymasterRepository $repository;
    public function __construct(CitymasterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($InputData)
    {
        try {

            $returnData = array();
            $per_page = (int) $InputData->getPerPage();

            $field_db = $InputData->getFieldDB();
            $search_val = $InputData->getSearchVal();

            if (($field_db == "") || ($field_db == NULL)) {
                $getData = Citymaster::paginate($per_page);
            } else {
                $getData = Citymaster::where($field_db, 'like', '%' . $search_val . '%')->paginate($per_page);
            }

            if (!empty($getData) && count($getData) >= 1) {

                $returnData['message'] = "Data Found";
                for ($i = 0; $i < count($getData); $i++) {
                    $returnData['data'][$i]['object'] = "citymaster";
                    $returnData['data'][$i]['id'] = $this->encode($getData[$i]->id);
                    $returnData['data'][$i]['country_id'] =  $this->encode($getData[$i]->country_id);
                    $returnData['data'][$i]['state_id'] = $this->encode($getData[$i]->state_id);
                    $state_data = Statemaster::select('state')->where('id', $getData[$i]->state_id)->first();
                    $returnData['data'][$i]['state'] = $state_data->state;
                    $returnData['data'][$i]['city'] = $getData[$i]->city;
                    $returnData['data'][$i]['is_active'] = $getData[$i]->is_active;
                    $returnData['data'][$i]['created_at'] = $getData[$i]->created_at;
                    $returnData['data'][$i]['updated_at'] = $getData[$i]->updated_at;
                }
                $returnData['meta']['pagination']['total'] = $getData->total();
                $returnData['meta']['pagination']['count'] = $getData->count();
                $returnData['meta']['pagination']['per_page'] = $getData->perPage();
                $returnData['meta']['pagination']['current_page'] = $getData->currentPage();
                $returnData['meta']['pagination']['total_pages'] = $getData->lastPage();
                $returnData['meta']['pagination']['links']['previous'] = $getData->previousPageUrl();
                $returnData['meta']['pagination']['links']['next'] = $getData->nextPageUrl();
            } else {

                $returnData['message'] = "Data Not Found";
                $returnData['object'] = "citymaster";
                $returnData['meta']['pagination']['total'] = $getData->total();
                $returnData['meta']['pagination']['count'] = $getData->count();
                $returnData['meta']['pagination']['per_page'] = $getData->perPage();
                $returnData['meta']['pagination']['current_page'] = $getData->currentPage();
                $returnData['meta']['pagination']['total_pages'] = $getData->lastPage();
                $returnData['meta']['pagination']['links']['previous'] = $getData->previousPageUrl();
                $returnData['meta']['pagination']['links']['next'] = $getData->nextPageUrl();
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
