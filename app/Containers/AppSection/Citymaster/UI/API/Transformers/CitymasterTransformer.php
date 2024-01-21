<?php

namespace App\Containers\AppSection\Citymaster\UI\API\Transformers;

use App\Containers\AppSection\Citymaster\Models\Citymaster;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class CitymasterTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Citymaster $citymaster): array
    {
        $response = [
            'object' => $citymaster->getResourceKey(),
            'id' => $citymaster->getHashedKey(),
        ];

        return $this->ifAdmin([
            'real_id' => $citymaster->id,
            'created_at' => $citymaster->created_at,
            'updated_at' => $citymaster->updated_at,
            'readable_created_at' => $citymaster->created_at->diffForHumans(),
            'readable_updated_at' => $citymaster->updated_at->diffForHumans(),
            // 'deleted_at' => $citymaster->deleted_at,
        ], $response);
    }
}
