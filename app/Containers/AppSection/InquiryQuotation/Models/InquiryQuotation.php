<?php

namespace App\Containers\AppSection\InquiryQuotation\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class InquiryQuotation extends ParentModel
{
    protected $fillable = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'InquiryQuotation';
}
