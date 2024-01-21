<?php

namespace App\Containers\AppSection\InquiryQuotation\Models;

use App\Ship\Parents\Models\Model as ParentModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends ParentModel
{
    use SoftDeletes;
    protected $table = 'mw_quotation';
    protected $fillable = [
        'id',
        'client_inquiry_id',
        'inquiry_code',
        'quotation_code',
        'product_name',
        'qty',
        'base_price',
        'extra_price',
        'discount_price',
        'remarks',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Quotation';
}
