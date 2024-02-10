<?php

namespace App\Containers\AppSection\Countrymaster\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Countrymaster\Data\Repositories\CountrymasterRepository;
use App\Containers\AppSection\Countrymaster\Models\Countrymaster;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllCountrymastersBySearchTask extends ParentTask
{
    use HashIdTrait;
    protected CountrymasterRepository $repository;
    public function __construct(CountrymasterRepository $repository)
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
                $getData = Countrymaster::paginate($per_page);
            } else {
                $getData = Countrymaster::where($field_db, 'like', '%' . $search_val . '%')->paginate($per_page);
            }

            if (!empty($getData) && count($getData) >= 1) {
                $returnData['message'] = "Data Found";
                for ($i = 0; $i < count($getData); $i++) {
                    $returnData['data'][$i]['object'] = "mw_countrymaster";
                    $returnData['data'][$i]['id'] = $this->encode($getData[$i]->id);

                    $returnData['data'][$i]['country'] = $getData[$i]->country;
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
                $returnData['object'] = "mw_countrymaster";
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
                'object' => 'mw_countrymaster',
                'data' => [],
            ];
        }
    }
}
