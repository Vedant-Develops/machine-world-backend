<?php

namespace App\Containers\AppSection\Tenantusers\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Tenantusers\Data\Repositories\TenantusersRepository;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindTenantusersByIdTask extends ParentTask
{
    use HashIdTrait;
    protected TenantusersRepository $repository;
    public function __construct(TenantusersRepository $repository)
    {
    }

    public function run($id)
    {
        try {
            $image_api_url = Themesettings::where('id', 1)->first();
            $getData = Tenantusers::where('id', $id)->first();
            if (!empty($getData)) {
                $returnData['result'] = true;
                $returnData['message'] = "Data found";
                $returnData['data']['object'] = "tenantusers";
                $returnData['data']['id'] = $this->encode($getData->id);
                $returnData['data']['role_id'] = $this->encode($getData->role_id);
                $returnData['data']['first_name'] = $getData->first_name;
                $returnData['data']['middle_name'] = $getData->middle_name;
                $returnData['data']['last_name'] = $getData->last_name;
                $returnData['data']['profile_image'] = ($getData->profile_image) ? $image_api_url->image_api_url . $getData->profile_image : "";
                $returnData['data']['dob'] = $getData->dob;
                $returnData['data']['gender'] = $getData->gender;
                $returnData['data']['email'] = $getData->email;
                $returnData['data']['mobile'] = $getData->mobile;
                $returnData['data']['address'] = $getData->address;
                $returnData['data']['country'] = $getData->country;
                $returnData['data']['state'] = $getData->state;
                $returnData['data']['city'] = $getData->city;
                $returnData['data']['zipcode'] = $getData->zipcode;
                $returnData['data']['is_active'] = $getData->is_active;
                $returnData['data']['created_by'] = $getData->created_by;
                $returnData['data']['updated_by'] = $getData->updated_by;
                $returnData['data']['created_at'] = $getData->created_at;
                $returnData['data']['updated_at'] = $getData->updated_at;
            } else {
                $returnData = [
                    'message' => 'Error: Data not found.',
                    'object' => 'tenantusers',
                    'data' => [],
                ];
            }
            return $returnData;
        } catch (Exception $e) {
            return [
                'result' => false,
                'message' => 'Error: Failed to find the resource. Please try again later.',
                'object' => 'tenantusers',
                'data' => [],
            ];
        }
    }
}
