<?php

namespace App\Containers\AppSection\Countrymaster\Data\Factories;

use App\Containers\AppSection\Countrymaster\Models\Countrymaster;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class CountrymasterFactory extends ParentFactory
{
    protected $model = Countrymaster::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
