<?php

namespace App\Containers\AppSection\Countrymaster\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class CountrymasterRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
