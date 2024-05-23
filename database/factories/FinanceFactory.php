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
        $transactionType = $this->faker->randomElement(['Entrada', 'Saída']);

        if ($transactionType == 'Entrada') {
            $title = $this->faker->randomElement(['Dízimos', 'Ofertas', 'Doações', 'Recebimentos']);
        } else {
            $title = $this->faker->randomElement(['Despesas de Energia', 'Despesas de Água', 'Materiais de Escritório','Reformas','Funcionários']);
        }

        return [
            'transaction_type' => $transactionType,
            'title' =>$title,
            'source' => $this->faker->randomElement(['Caixa', 'Banco']),
            'date_transfer' => $this->faker->dateTimeBetween($startOfMonth, $endOfMonth)->format('Y-m-d'),
            'value' => $this->faker->randomFloat(2, 100, 5000),
            'description' => $this->faker->optional()->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
