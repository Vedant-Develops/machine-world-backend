<?php

namespace App\Containers\AppSection\Citymaster\Models;

use App\Ship\Parents\Models\Model as ParentModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Citymaster extends ParentModel
{
    use SoftDeletes;
    protected $table = 'mw_citymaster';
    protected $fillable = [
        'id',
        'country_id',
        'state_id',
        'city',
        'is_active'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Citymaster';
}
