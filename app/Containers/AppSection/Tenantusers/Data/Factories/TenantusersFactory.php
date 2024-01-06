<?php

namespace App\Containers\AppSection\Tenantusers\Data\Factories;

use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class TenantusersFactory extends ParentFactory
{
    protected $model = Tenantusers::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
