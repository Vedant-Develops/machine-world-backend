<?php

namespace App\Containers\AppSection\Tenantusers\Actions;

use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Containers\AppSection\Tenantusers\Tasks\FindTenantusersByIdTask;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\FindTenantusersByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindTenantusersByIdAction extends ParentAction
{
   
    public function run(FindTenantusersByIdRequest $request)
    {
        return app(FindTenantusersByIdTask::class)->run($request->id);
    }
}
