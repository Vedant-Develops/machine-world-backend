<?php

namespace App\Containers\AppSection\UserActivity\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\UserActivity\Data\Repositories\UserActivityRepository;
use App\Containers\AppSection\UserActivity\Models\UserActivity;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateUserActivityTask extends ParentTask
{
    use HashIdTrait;
    protected UserActivityRepository $repository;
    public function __construct(UserActivityRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($data)
    {
        //   try {
        $returnData = array();
        $create = UserActivity::create($data);
        $getData = UserActivity::where('id', $create->id)->first();
        if (!empty($getData)) {
            $returnData['message'] = "Data Created";
            $returnData['data']['object'] = "mw_user_activity";
            $returnData['data']['id'] = $this->encode($getData->id);
            $returnData['data']['user_id'] = $this->encode($getData->user_id);
            $returnData['data']['role_name'] = $getData->role_name;
            $returnData['data']['event_name'] = $getData->event_name;
            $returnData['data']['module'] = $getData->module;
            $returnData['data']['created_by'] = $this->encode($getData->created_by);
            $returnData['data']['created_at'] = $getData->created_at;
            $returnData['data']['updated_at'] = $getData->updated_at;
            $returnData['data']['deleted_at'] = $getData->deleted_at;
        } else {
            $returnData['message'] = "Data Not Created";
            $returnData['object'] = "mw_user_activity";
        }

        return $returnData;
        // } catch (Exception) {
        //     throw new CreateResourceFailedException();
        // }
    }
}
