<?php

namespace App\Containers\AppSection\ProductType\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class ProductTypeRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
