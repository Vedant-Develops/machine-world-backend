<?php

namespace App\Containers\AppSection\Statemaster\Data\Factories;

use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class StatemasterFactory extends ParentFactory
{
    protected $model = Statemaster::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
