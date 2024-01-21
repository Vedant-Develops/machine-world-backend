<?php

namespace App\Containers\AppSection\Statemaster\Models;

use App\Ship\Parents\Models\Model as ParentModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statemaster extends ParentModel
{
    use SoftDeletes;
    protected $table = 'mw_statemaster';
    protected $fillable = [
        'id',
        'country_id',
        'state',
        'is_active'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Statemaster';
}
