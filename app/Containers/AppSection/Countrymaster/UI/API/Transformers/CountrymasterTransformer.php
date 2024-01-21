<?php

namespace App\Containers\AppSection\Countrymaster\UI\API\Transformers;

use App\Containers\AppSection\Countrymaster\Models\Countrymaster;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class CountrymasterTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Countrymaster $countrymaster): array
    {
        $response = [
            'object' => $countrymaster->getResourceKey(),
            'id' => $countrymaster->getHashedKey(),
        ];

        return $this->ifAdmin([
            'real_id' => $countrymaster->id,
            'created_at' => $countrymaster->created_at,
            'updated_at' => $countrymaster->updated_at,
            'readable_created_at' => $countrymaster->created_at->diffForHumans(),
            'readable_updated_at' => $countrymaster->updated_at->diffForHumans(),
            // 'deleted_at' => $countrymaster->deleted_at,
        ], $response);
    }
}
