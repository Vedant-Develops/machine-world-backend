<?php

namespace App\Containers\AppSection\Citymaster\Data\Factories;

use App\Containers\AppSection\Citymaster\Models\Citymaster;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class CitymasterFactory extends ParentFactory
{
    protected $model = Citymaster::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
