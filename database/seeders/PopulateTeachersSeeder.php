<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserAccount;
use App\Models\Teacher;

class PopulateTeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all teachers from user_accounts that don't have a teacher record
        $teachers = UserAccount::where('role', 'teacher')->get();

        foreach ($teachers as $userAccount) {
            // Check if teacher record already exists
            if (!Teacher::where('user_account_id', $userAccount->id)->exists()) {
                Teacher::create([
                    'user_account_id' => $userAccount->id,
                    'fname' => 'Teacher', // Default first name
                    'lname' => $userAccount->username, // Use username as last name
                    'email' => $userAccount->email,
                    'phone' => null, // Will be added later
                ]);
            }
        }

        $this->command->info('Teachers table populated successfully!');
    }
}
