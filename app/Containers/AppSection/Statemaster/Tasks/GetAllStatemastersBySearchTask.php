<?php

namespace App\Containers\AppSection\Statemaster\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Statemaster\Data\Repositories\StatemasterRepository;
use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllStatemastersBySearchTask extends ParentTask
{
    use HashIdTrait;
    public function __construct(
        protected StatemasterRepository $repository
    ) {
    }


    public function run($InputData)
    {
        try {

            $returnData = array();
            $per_page = (int) $InputData->getPerPage();
            $field_db = $InputData->getFieldDB();
            $search_val = $InputData->getSearchVal();

            if (($field_db == "") || ($field_db == NULL)) {
                $getData = Statemaster::paginate($per_page);
            } else {
                if ($field_db == "country_id") {
                    $search_val = $this->decode($search_val);
                }
                $getData = Statemaster::where($field_db, 'like', '%' . $search_val . '%')->paginate($per_page);
            }

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
                $returnData['meta']['pagination']['total'] = $getData->total();
                $returnData['meta']['pagination']['count'] = $getData->count();
                $returnData['meta']['pagination']['per_page'] = $getData->perPage();
                $returnData['meta']['pagination']['current_page'] = $getData->currentPage();
                $returnData['meta']['pagination']['total_pages'] = $getData->lastPage();
                $returnData['meta']['pagination']['links']['previous'] = $getData->previousPageUrl();
                $returnData['meta']['pagination']['links']['next'] = $getData->nextPageUrl();
            } else {
                $returnData['message'] = "Data Not Found";
                $returnData['object'] = "mw_statemaster";
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
                'object' => 'mw_statemaster',
                'data' => [],
            ];
        }
    }
}
