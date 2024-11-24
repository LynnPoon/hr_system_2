<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin', // Set role
        ]);

        User::factory()->create([
          'name' => 'Tom',
          'email' => 'tom@example.com',
          'password' => Hash::make('password'),
          'role' => 'employee', // Set role
      ]);

      User::factory()->create([
        'name' => 'Sam',
        'email' => 'sam@example.com',
        'password' => Hash::make('password'),
        'role' => 'employee', // Set role
    ]);


    $this->call([
      DepartmentSeeder::class,
      EmployeeSeeder::class
  ]);

    }
}
