<?php

namespace Database\Factories;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cart::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => 1,
            'product_id' => 1,
            'name' => $this->faker->name(),
            'quantity' => rand(1, 15),
            'price' => rand(1000, 15000),
            'sub_total' => rand(10000, 1500000),
        ];
    }
}
