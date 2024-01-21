<?php

namespace App\Containers\AppSection\InquiryQuotation\Data\Factories;

use App\Containers\AppSection\InquiryQuotation\Models\InquiryQuotation;
use App\Ship\Parents\Factories\Factory as ParentFactory;

class InquiryQuotationFactory extends ParentFactory
{
    protected $model = InquiryQuotation::class;

    public function definition(): array
    {
        return [
            // Add your model fields here
            // 'name' => $this->faker->name(),
        ];
    }
}
