<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'cpf' => $this->faker->unique()->numerify('###.###.###-##'),
            'rg' => $this->faker->unique()->numerify('MG-##.###.###'),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'whatsapp' => $this->faker->phoneNumber,
            'address_zipcode' => $this->faker->postcode,
            'address_street' => $this->faker->streetAddress,
            'address_number' => $this->faker->buildingNumber,
            'address_neighborhood' => $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
            'birthdate' => $this->faker->date,
            'joined_at' => $this->faker->dateTime,
            'status_id' => Status::factory(),
            'photo' => 'members/default.png',
            'baptism_date' => $this->faker->dateTime,
            'profession' => $this->faker->jobTitle,
        ];
    }
}
