<?php

namespace App\Containers\AppSection\InquiryQuotation\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class InquiryQuotationRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
