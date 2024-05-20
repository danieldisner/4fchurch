<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\pt_BR\Person;
use Faker\Provider\pt_BR\PhoneNumber;
use Faker\Provider\pt_BR\Address;

class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition()
    {
        $faker = $this->faker;
        $faker->addProvider(new Person($faker));
        $faker->addProvider(new PhoneNumber($faker));
        $faker->addProvider(new Address($faker));

        return [
            'name' => $faker->name,
            'cpf' => preg_replace('/[^0-9]/', '', $faker->cpf),
            'rg' => preg_replace('/[^0-9]/', '', $faker->rg),
            'email' => $faker->unique()->safeEmail,
            'phone' => preg_replace('/[^0-9]/', '', $faker->cellphoneNumber),
            'whatsapp' => preg_replace('/[^0-9]/', '', $faker->cellphoneNumber),
            'address_zipcode' => preg_replace('/[^0-9]/', '', $faker->postcode),
            'address_street' => $faker->streetAddress,
            'address_number' => $faker->buildingNumber,
            'address_neighborhood' => $faker->secondaryAddress,
            'city' => $faker->city,
            'uf' => $faker->stateAbbr,
            'birthdate' => $faker->date,
            'joined_at' => $faker->dateTime,
            'status_id' => Status::factory(),
            'photo' => 'members/default.png',
            'baptism_date' => $faker->dateTime,
            'profession' => $faker->jobTitle,
        ];
    }
}
