<?php

namespace Src\App\Console;

use Faker\Factory;
use Src\App\Models\Employee;

class DataController
{
    public function seed()
    {
        echo "\nStarting seeding... \n\n";
        $faker = Factory::create();

        try {
            $count = 10000;
            for ($i = 1; $i <= $count; $i++) {
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

                $progress = $i * 100 / $count;
                if (in_array($progress, [20, 40, 60, 80])) {
                    echo "$progress%... \n";
                }
            }
        } catch (\Throwable $exception) {
            dd($exception);
        }
        echo "\nSeeding completed! \n\n";
    }
}