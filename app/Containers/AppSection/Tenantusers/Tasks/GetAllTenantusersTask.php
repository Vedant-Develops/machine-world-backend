<?php

namespace App\Containers\AppSection\Tenantusers\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Tenantusers\Data\Repositories\TenantusersRepository;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllTenantusersTask extends ParentTask
{
    use HashIdTrait;
    protected TenantusersRepository $repository;
    public function __construct(TenantusersRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($InputData)
    {
        try {
            $per_page = (int) $InputData->getPerPage();
            $field_db = $InputData->getFieldDB();
            $search_val = $InputData->getSearchVal();
            $image_api_url = Themesettings::where('id', 1)->first();
            if (($field_db == "") || ($field_db == NULL)) {
                $getData = Tenantusers::paginate($per_page);
            } else {
                if ($field_db == "role_id") {
                    $search_val = $this->decode($search_val);
                }
                $getData = Tenantusers::where($field_db, 'like', '%' . $search_val . '%')->paginate($per_page);
            }
            if (!empty($getData) && count($getData) >= 1) {
                for ($i = 0; $i < count($getData); $i++) {
                    $returnData['message'] = "Data found";
                    $returnData['data'][$i]['object'] = "tenantusers";
                    $returnData['data'][$i]['id'] = $this->encode($getData[$i]->id);
                    $returnData['data'][$i]['role_id'] = $this->encode($getData[$i]->role_id);
                    $returnData['data'][$i]['first_name'] = $getData[$i]->first_name;
                    $returnData['data'][$i]['middle_name'] = $getData[$i]->middle_name;
                    $returnData['data'][$i]['last_name'] = $getData[$i]->last_name;
                    $returnData['data'][$i]['profile_image'] = ($getData[$i]->profile_image) ? $image_api_url->image_api_url . $getData[$i]->profile_image : "";
                    $returnData['data'][$i]['dob'] = $getData[$i]->dob;
                    $returnData['data'][$i]['gender'] = $getData[$i]->gender;
                    $returnData['data'][$i]['email'] = $getData[$i]->email;
                    $returnData['data'][$i]['mobile'] = $getData[$i]->mobile;
                    $returnData['data'][$i]['address'] = $getData[$i]->address;
                    $returnData['data'][$i]['country'] = $getData[$i]->country;
                    $returnData['data'][$i]['state'] = $getData[$i]->state;
                    $returnData['data'][$i]['city'] = $getData[$i]->city;
                    $returnData['data'][$i]['zipcode'] = $getData[$i]->zipcode;
                    $returnData['data'][$i]['is_active'] = $getData[$i]->is_active;
                    $returnData['data'][$i]['created_by'] = $getData[$i]->created_by;
                    $returnData['data'][$i]['updated_by'] = $getData[$i]->updated_by;
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
                $returnData = [
                    'message' => 'Error: Data not found.',
                    'object' => 'tenantusers',
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
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to find the resource. Please try again later.',
                'object' => 'tenantusers',
                'data' => [],
            ];
        }
    }
}
