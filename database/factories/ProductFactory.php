<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => rand(1, 10),
            'supplier_id' => rand(1, 10),
            'name' => $this->faker->name,
            'code' => rand(),
            'root' => $this->faker->name,
            'qty' => rand(1, 20),
            'buying_price' => rand(100, 10000),
            'selling_price' => rand(100, 10000),
            'buy_date' => $this->faker->date()
        ];
    }
}
