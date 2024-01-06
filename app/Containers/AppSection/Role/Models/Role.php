<?php

namespace App\Containers\AppSection\Role\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Role extends ParentModel
{
    protected $table = 'mw_roles';
    protected $fillable = [
      'id',
      'name',
    ];


    protected $hidden = [

    ];

    protected $casts = [

    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Role';
}
