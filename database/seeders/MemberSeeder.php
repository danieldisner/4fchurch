<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\Status;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = Status::all();

        foreach ($statuses as $status) {
            Member::factory()->count(10)->create([
                'status_id' => $statuses->random()->id
            ]);
        }
    }
}
