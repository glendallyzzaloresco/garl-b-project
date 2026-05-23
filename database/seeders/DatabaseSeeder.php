<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Degree;
use App\Models\UserAccount;
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
        // NOTE: This seeder runs in production on Render. Keep it deterministic,
        // idempotent, and independent of Faker (composer install --no-dev).

        $degrees = collect([
            'Bachelor of Science',
            'Bachelor of Arts',
            'Master of Science',
        ])->map(fn (string $title) => Degree::firstOrCreate(['degree_title' => $title]));

        $this->call(UserAccountSeeder::class);

        $studentAccountId = UserAccount::where('email', 'student1@example.com')->value('id');

        $defaultDegreeId = $degrees->first()?->id;

        for ($i = 1; $i <= 3; $i++) {
            $student = Student::firstOrCreate(
                ['email' => "student{$i}@example.com"],
                [
                    'fname' => 'Student',
                    'mname' => 'A',
                    'lname' => (string) $i,
                    'contactInfo' => '000-000-0000',
                    'degree_id' => $defaultDegreeId,
                    'user_account_id' => $i === 1 ? $studentAccountId : null,
                ]
            );

            // Repair link if the student already existed from a prior seed.
            if ($i === 1 && $studentAccountId && !$student->user_account_id) {
                $student->update(['user_account_id' => $studentAccountId]);
            }
        }
    }
}
