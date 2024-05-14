<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'Falecido',
            'Mudou-se',
            'Ativo',
            'Inativo',
        ];

        foreach ($statuses as $statusName) {
            Status::create(['name' => $statusName]);
        }
    }
}
