<?php

namespace App\Containers\AppSection\ProductType\Models;

use App\Ship\Parents\Models\Model as ParentModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends ParentModel
{
    use SoftDeletes;
    protected $table = 'mw_product_type';
    protected $fillable = [
        "type",
        "is_active",
    ];
    protected $dates = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];
    protected $hidden = [];

    protected $casts = [];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'ProductType';
}
