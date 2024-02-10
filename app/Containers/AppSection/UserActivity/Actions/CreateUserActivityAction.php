<?php

namespace App\Containers\AppSection\UserActivity\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Role\Models\Role;
use App\Containers\AppSection\UserActivity\Models\UserActivity;
use App\Containers\AppSection\UserActivity\Tasks\CreateUserActivityTask;
use App\Containers\AppSection\UserActivity\UI\API\Requests\CreateUserActivityRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Auth;

class CreateUserActivityAction extends ParentAction
{
    use HashIdTrait;
    public function run(CreateUserActivityRequest $request, $InputData)
    {
        $getUser = Auth::user();
        $user_id = $this->decode($InputData->getUserId());
        $role_id = $this->decode($InputData->getRoleId());
        $getRoleName = Role::select('name')->where('id', $role_id)->first();
        $data = $request->sanitizeInput([

            "role_name" => $getRoleName->name,
            "event_name" => $InputData->getEventName(),
            "module" => $InputData->getModule(),
            "created_by" => $getUser['id'],
        ]);
        $data['user_id'] = $user_id;
        return app(CreateUserActivityTask::class)->run($data);
    }
}
