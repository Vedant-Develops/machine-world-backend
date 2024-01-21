<?php

namespace App\Containers\AppSection\Statemaster\UI\API\Transformers;

use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class StatemasterTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Statemaster $statemaster): array
    {
        $response = [
            'object' => $statemaster->getResourceKey(),
            'id' => $statemaster->getHashedKey(),
        ];

        return $this->ifAdmin([
            'real_id' => $statemaster->id,
            'created_at' => $statemaster->created_at,
            'updated_at' => $statemaster->updated_at,
            'readable_created_at' => $statemaster->created_at->diffForHumans(),
            'readable_updated_at' => $statemaster->updated_at->diffForHumans(),
            // 'deleted_at' => $statemaster->deleted_at,
        ], $response);
    }
}
