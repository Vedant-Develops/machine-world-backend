<?php

namespace App\Containers\AppSection\UserActivity\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class UserActivity extends ParentModel
{
    protected $table = "mw_user_activity";
    protected $fillable = [
        "id",
        "user_id",
        "role_name",
        "event_name",
        "module",
        "created_by",
    ];

    protected $hidden = [];

    protected $casts = [];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'UserActivity';
}
