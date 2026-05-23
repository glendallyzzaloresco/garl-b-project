<?php

namespace Database\Seeders;

use App\Models\UserAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'is_active' => 1,
                'password' => Hash::make('password'),
                'password_changed' => false,
            ],
            [
                'username' => 'teacher1',
                'email' => 'teacher1@example.com',
                'role' => 'teacher',
                'is_active' => 1,
                'password' => Hash::make('password'),
                'password_changed' => false,
            ],
            [
                'username' => 'student1',
                'email' => 'student1@example.com',
                'role' => 'student',
                'is_active' => 1,
                'password' => Hash::make('password'),
                'password_changed' => false,
            ],
        ];

        foreach ($accounts as $account) {
            UserAccount::updateOrCreate(
                ['email' => $account['email']],
                $account
            );
        }
    }
}
