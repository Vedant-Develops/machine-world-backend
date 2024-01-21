<?php

namespace App\Containers\AppSection\Products\Models;

use App\Ship\Parents\Models\Model as ParentModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends ParentModel
{
    use SoftDeletes;
    protected $table = 'mw_products';
    protected $fillable = [
        "name",
        "product_type_id",
        "height",
        "width",
        "length",
        "weight",
        "power",
        "product_video",
        "product_image",
        "product_specification",
        "motor_type",
        "diagram_type",
        "diagram_value",
        "price",
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
    protected string $resourceKey = 'Products';
}
