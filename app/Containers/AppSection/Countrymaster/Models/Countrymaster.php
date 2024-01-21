<?php

namespace App\Containers\AppSection\Countrymaster\Models;

use App\Ship\Parents\Models\Model as ParentModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Countrymaster extends ParentModel
{
    use SoftDeletes;
    protected $table = 'mw_countrymaster';
    protected $fillable = [
        'id',
        'country',
        'is_active',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Countrymaster';
}
