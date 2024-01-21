<?php

namespace App\Containers\AppSection\Products\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class ProductsRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
