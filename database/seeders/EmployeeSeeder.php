<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

      // Find the users created in the DatabaseSeeder (avoiding duplication)
      $employee1 = User::where('email', 'tom@example.com')->first();
      $employee2 = User::where('email', 'sam@example.com')->first();

      // Associate employees with users
      Employee::create([
          'first_name' => 'Tom',
          'last_name' => 'Jones',
          'position' => 'Developer',
          'department_id' => 1, // Assuming department exists
          'date_of_employment' => now(),
          'salary' => 50000,
          'phone_num' => '1234567890',
          'user_id' => $employee1->id,
      ]);

      Employee::create([
          'first_name' => 'Sam',
          'last_name' => 'Smith',
          'position' => 'Manager',
          'department_id' => 1, // Assuming department exists
          'date_of_employment' => now(),
          'salary' => 60000,
          'phone_num' => '0987654321',
          'user_id' => $employee2->id,
      ]);
    }
}
