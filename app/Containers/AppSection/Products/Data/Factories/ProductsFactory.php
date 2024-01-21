<?php

namespace App\Containers\AppSection\Products\Data\Factories;

use App\Containers\AppSection\Products\Models\Products;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class ProductsFactory extends ParentFactory
{
    protected $model = Products::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
