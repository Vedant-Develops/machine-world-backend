<?php

namespace App\Containers\AppSection\Citymaster\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class CitymasterRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
