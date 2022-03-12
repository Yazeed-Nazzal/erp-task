<?php

namespace Database\Factories\products;

use App\Models\users\Merchant;
use Database\Factories\users\MerchantFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\products\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'product ' . mt_rand(1,100),
            'merchant_id' => Merchant::factory()->create()->id,
            'price'   => mt_rand(20,1000),
            'status' => 1

        ];
    }
}
