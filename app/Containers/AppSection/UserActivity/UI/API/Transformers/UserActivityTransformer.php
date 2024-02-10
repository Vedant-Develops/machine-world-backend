<?php

namespace App\Containers\AppSection\UserActivity\UI\API\Transformers;

use App\Containers\AppSection\UserActivity\Models\UserActivity;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class UserActivityTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(UserActivity $useractivity): array
    {
        $response = [
            'object' => $useractivity->getResourceKey(),
            'id' => $useractivity->getHashedKey(),
        ];

        return $this->ifAdmin([
            'real_id' => $useractivity->id,
            'created_at' => $useractivity->created_at,
            'updated_at' => $useractivity->updated_at,
            'readable_created_at' => $useractivity->created_at->diffForHumans(),
            'readable_updated_at' => $useractivity->updated_at->diffForHumans(),
            // 'deleted_at' => $useractivity->deleted_at,
        ], $response);
    }
}
