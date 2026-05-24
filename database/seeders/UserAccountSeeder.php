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
            // IMPORTANT: This seeder runs on Render during deploy.
            // It must be idempotent and avoid unique key violations.
            // We therefore locate existing accounts by username OR email.

            $user = UserAccount::query()
                ->where('username', $account['username'])
                ->orWhere('email', $account['email'])
                ->first();

            $isNew = false;
            if (!$user) {
                $user = new UserAccount();
                $isNew = true;
            }

            // Keep role flags aligned for these known demo/system accounts.
            $user->role = $account['role'];
            $user->is_active = $account['is_active'];

            // Align username/email only if it won't conflict with another row.
            if (empty($user->username) || $user->username === $account['username']) {
                $user->username = $account['username'];
            } else {
                $usernameTaken = UserAccount::query()
                    ->where('username', $account['username'])
                    ->where('id', '!=', $user->id)
                    ->exists();
                if (!$usernameTaken) {
                    $user->username = $account['username'];
                }
            }

            if (empty($user->email) || $user->email === $account['email']) {
                $user->email = $account['email'];
            } else {
                $emailTaken = UserAccount::query()
                    ->where('email', $account['email'])
                    ->where('id', '!=', $user->id)
                    ->exists();
                if (!$emailTaken) {
                    $user->email = $account['email'];
                }
            }

            // Only set the default password when first creating the account.
            // Avoid wiping user-updated passwords on every deploy.
            if ($isNew) {
                $user->password = $account['password'];
                $user->password_changed = $account['password_changed'];
            }

            $user->save();
        }
    }
}
