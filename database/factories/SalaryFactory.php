<?php

namespace Database\Factories;

use App\Models\Salary;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Salary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => rand(1, 15),
            'amount' => rand(15000, 50000),
            'date' => date('Y-m-y'),
            'month' => date('F'),
            'year' => date('Y')
        ];
    }
}
