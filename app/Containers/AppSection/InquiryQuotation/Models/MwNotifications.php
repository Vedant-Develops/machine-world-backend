<?php

namespace App\Containers\AppSection\InquiryQuotation\Models;

use App\Ship\Parents\Models\Model as ParentModel;
// use OwenIt\Auditing\Contracts\Auditable;

class MwNotifications extends ParentModel
{
    //  use \OwenIt\Auditing\Auditable;
    protected $table = 'mw_notifications';
    protected $fillable = [
        'id',
        'user_to_notify',
        'user_who_fired_event',
        'message',
        'is_seen',
        'module',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [];

    protected $casts = [];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'MwNotifications';
}
