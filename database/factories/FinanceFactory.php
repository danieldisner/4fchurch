<?php

namespace Database\Factories;

use App\Models\Finance;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceFactory extends Factory
{
    protected $model = Finance::class;

    public function definition()
    {
        $startOfYear = now()->startOfYear();
        $endOfYear = now()->endOfYear();

        // 70% chance of being 'Entrada', 30% chance of being 'Saída'
        $transactionType = $this->faker->randomElement(array_merge(
            array_fill(0, 7, 'Entrada'),
            array_fill(0, 3, 'Saída')
        ));

        $title = $transactionType == 'Entrada'
            ? $this->faker->randomElement(['Dízimos', 'Ofertas', 'Doações', 'Recebimentos'])
            : $this->faker->randomElement(['Despesas de Energia', 'Despesas de Água', 'Materiais de Escritório', 'Reformas', 'Funcionários', 'Pagamentos']);

        return [
            'transaction_type' => $transactionType,
            'title' => $title,
            'source' => $this->faker->randomElement(['Caixa', 'Banco']),
            'date_transfer' => $this->faker->dateTimeBetween($startOfYear, $endOfYear)->format('Y-m-d'),
            'value' => $this->faker->randomFloat(2, 100, 5000),
            'description' => $this->faker->optional()->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
