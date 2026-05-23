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
            $user = UserAccount::firstOrNew(['email' => $account['email']]);

            // Always keep these fields aligned
            $user->username = $account['username'];
            $user->role = $account['role'];
            $user->is_active = $account['is_active'];

            // Only set the default password when first creating the account.
            // This avoids wiping user-updated passwords on every container boot.
            if (!$user->exists) {
                $user->password = $account['password'];
                $user->password_changed = $account['password_changed'];
            }

            $user->save();
        }
    }
}
