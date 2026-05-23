<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Degree;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create degrees first
        Degree::create(['degree_title' => 'Bachelor of Science']);
        Degree::create(['degree_title' => 'Bachelor of Arts']);
        Degree::create(['degree_title' => 'Master of Science']);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create 10 sample students
        Student::factory(10)->create();
    }
}
