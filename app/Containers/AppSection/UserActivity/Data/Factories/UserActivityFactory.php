<?php

namespace App\Containers\AppSection\UserActivity\Data\Factories;

use App\Containers\AppSection\UserActivity\Models\UserActivity;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class UserActivityFactory extends ParentFactory
{
    protected $model = UserActivity::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
