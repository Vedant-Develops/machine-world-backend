<?php

namespace App\Containers\AppSection\Tenantusers\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Containers\AppSection\Tenantusers\Tasks\UpdateTenantusersByFieldsTask;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\UpdateTenantusersRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateTenantusersByFieldsAction extends ParentAction
{
    public function run(UpdateTenantusersRequest $request,$InputData)
    {
   
        return app(UpdateTenantusersByFieldsTask::class)->run($request->id, $InputData);
    }
}
