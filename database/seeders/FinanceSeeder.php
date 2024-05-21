<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Finance;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Finance::factory()->count(10)->create();
    }
}
