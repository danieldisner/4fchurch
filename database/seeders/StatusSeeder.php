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
            'Falecido' => 'bg-gray-100 text-black-800',
            'Mudou-se' => 'text-blue-800 bg-blue-100',
            'Ativo' => 'text-green-800 bg-green-100',
            'Inativo' => 'text-red-800 bg-red-100',
        ];

        foreach ($statuses as $status => $tailwind_classes) {
            Status::create([
                'name' => $status,
                'tailwind_classes' => $tailwind_classes
            ]);
        }
    }
}
