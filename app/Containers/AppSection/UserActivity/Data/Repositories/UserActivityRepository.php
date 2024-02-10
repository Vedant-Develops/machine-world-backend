<?php

namespace App\Containers\AppSection\UserActivity\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class UserActivityRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
