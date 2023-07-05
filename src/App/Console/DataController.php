<?php

namespace Src\App\Console;

use Faker\Factory;
use Src\App\Models\Employee;

class DataController
{
    public function seed()
    {
        var_dump('work');
        $faker = Factory::create();

        try {
            for ($i = 1; $i <= 10000; $i++) {
                $employee = new Employee([
                    'first_name' => $faker->firstName(),
                    'last_name' => $faker->lastName(),
                    'position' => $faker->company(),
                    'email' => $faker->email(),
                    'phone' => $faker->phoneNumber(),
                    'manager_id' => $i > 1 ? $faker->randomElement([null, random_int(1, $i - 1)]) : null,
                    'notes' => $faker->randomElement([null, $faker->realText()]),
                ]);
                $employee->save();
            }
        } catch (\Throwable $exception) {
            dd($exception);
        }
        var_dump('end');
    }
}