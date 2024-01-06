<?php

namespace App\Containers\AppSection\Role\UI\API\Transformers;

use App\Containers\AppSection\Role\Models\Role;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class RoleTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Role $role): array
    {
        $response = [
            'object' => $role->getResourceKey(),
            'id' => $role->getHashedKey(),
            'name' => $role->name,
            'created_at' => $role->created_at,
            'updated_at' => $role->updated_at,
            'readable_created_at' => $role->created_at->diffForHumans(),
            'readable_updated_at' => $role->updated_at->diffForHumans(),

        ];

        return $response;
    }
}
