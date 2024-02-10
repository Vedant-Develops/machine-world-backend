<?php

namespace App\Containers\AppSection\UserActivity\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\UserActivity\Data\Repositories\UserActivityRepository;
use App\Containers\AppSection\UserActivity\Models\UserActivity;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllUserActivitiesBySearchTask extends ParentTask
{
    use HashIdTrait;
    protected UserActivityRepository $repository;
    public function __construct(UserActivityRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($InputData)
    {
        try {
            $per_page = (int) $InputData->getPerPage();
            $field_db = $InputData->getFieldDB();
            $search_val = $InputData->getSearchVal();
            $date_from = $InputData->getDateFrom();
            $date_to = $InputData->getDateTo();

            if (($field_db == "") || ($field_db == NULL)) {
                if (!empty($date_from) && !empty($date_to)) {
                    $getData = UserActivity::where('created_at', '>=', $date_from)
                        ->where('created_at', '<=', $date_to . ' 23:59:59')
                        ->orderBy('created_at', 'DESC')->paginate($per_page);
                } else {
                    $getData = UserActivity::orderBy('created_at', 'DESC')->paginate($per_page);
                }
            } else {
                if ($field_db == "user_id") {
                    $search_val = $this->decode($search_val);
                }
                if (!empty($date_from) && !empty($date_to)) {
                    $getData = UserActivity::where('created_at', '>=', $date_from)
                        ->where('created_at', '<=', $date_to . ' 23:59:59')
                        ->where($field_db, 'like', '%' . $search_val . '%')
                        ->orderBy('created_at', 'DESC')
                        ->paginate($per_page);
                } else {
                    $getData = UserActivity::where($field_db, 'like', '%' . $search_val . '%')
                        ->orderBy('created_at', 'DESC')
                        ->paginate($per_page);
                }
            }
            if (!empty($getData) && count($getData) >= 1) {
                for ($i = 0; $i < count($getData); $i++) {
                    $returnData['message'] = "Data found";
                    $returnData['data'][$i]['object'] = "mw_user_activity";
                    $returnData['data'][$i]['id'] = $this->encode($getData[$i]->id);
                    $returnData['data'][$i]['user_id'] = $this->encode($getData[$i]->user_id);
                    $returnData['data'][$i]['role_name'] = $getData[$i]->role_name;
                    $returnData['data'][$i]['event_name'] = $getData[$i]->event_name;
                    $returnData['data'][$i]['module'] = $getData[$i]->module;
                    $returnData['data'][$i]['created_by'] = $this->encode($getData[$i]->created_by);
                    $returnData['data'][$i]['created_at'] = $getData[$i]->created_at;
                    $returnData['data'][$i]['updated_at'] = $getData[$i]->updated_at;
                    $returnData['data'][$i]['deleted_at'] = $getData[$i]->deleted_at;
                }
                $returnData['meta']['pagination']['total'] = $getData->total();
                $returnData['meta']['pagination']['count'] = $getData->count();
                $returnData['meta']['pagination']['per_page'] = $getData->perPage();
                $returnData['meta']['pagination']['current_page'] = $getData->currentPage();
                $returnData['meta']['pagination']['total_pages'] = $getData->lastPage();
                $returnData['meta']['pagination']['links']['previous'] = $getData->previousPageUrl();
                $returnData['meta']['pagination']['links']['next'] = $getData->nextPageUrl();
            } else {
                $returnData = [
                    'message' => 'Error: Data not found.',
                    'object' => 'mw_user_activity',
                    'data' => [],
                ];
                $returnData['meta']['pagination']['total'] = $getData->total();
                $returnData['meta']['pagination']['count'] = $getData->count();
                $returnData['meta']['pagination']['per_page'] = $getData->perPage();
                $returnData['meta']['pagination']['current_page'] = $getData->currentPage();
                $returnData['meta']['pagination']['total_pages'] = $getData->lastPage();
                $returnData['meta']['pagination']['links']['previous'] = $getData->previousPageUrl();
                $returnData['meta']['pagination']['links']['next'] = $getData->nextPageUrl();
            }
            return $returnData;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
