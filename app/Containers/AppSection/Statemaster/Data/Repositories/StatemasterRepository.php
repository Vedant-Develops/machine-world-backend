<?php

namespace App\Containers\AppSection\Statemaster\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class StatemasterRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
