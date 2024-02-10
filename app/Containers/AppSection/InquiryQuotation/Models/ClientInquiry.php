<?php

namespace App\Containers\AppSection\InquiryQuotation\Models;

use App\Ship\Parents\Models\Model as ParentModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientInquiry extends ParentModel
{
    use SoftDeletes;
    protected $table = 'mw_client_inquiries';
    protected $fillable = [
        'id',
        'inquiry_code',
        'client_name',
        'mobile',
        'email',
        'country',
        'state',
        'city',
        'village',
        'address',
        'company_name',
        'followup_date',
        'existing_machines',
        'remarks',
        'delivery_time_period',
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
    protected string $resourceKey = 'ClientInquiry';
}
