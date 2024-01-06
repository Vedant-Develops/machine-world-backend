<?php

namespace App\Containers\AppSection\Tenantusers\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class TenantusersRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
