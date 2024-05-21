<?php

namespace Database\Factories;

use App\Models\Finance;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceFactory extends Factory
{
    protected $model = Finance::class;

    public function definition()
    {
        // Obtém o primeiro e o último dia do mês atual
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        return [
            'transaction_type' => $this->faker->randomElement(['Entrada', 'Saída']),
            'title' => $this->faker->sentence(3),
            'source' => $this->faker->randomElement(['Caixa', 'Banco']),
            'date_transfer' => $this->faker->dateTimeBetween($startOfMonth, $endOfMonth)->format('Y-m-d'),
            'value' => $this->faker->randomFloat(2, 100, 10000),
            'description' => $this->faker->optional()->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
