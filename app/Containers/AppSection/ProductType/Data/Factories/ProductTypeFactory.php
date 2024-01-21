<?php

namespace App\Containers\AppSection\ProductType\Data\Factories;

use App\Containers\AppSection\ProductType\Models\ProductType;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class ProductTypeFactory extends ParentFactory
{
    protected $model = ProductType::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
