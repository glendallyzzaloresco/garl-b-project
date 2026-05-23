<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\UserAccount;
use App\Models\Student;

$users = UserAccount::where('role', 'student')->get();

foreach ($users as $user) {
    // Check if student already exists
    $studentExists = Student::where('user_account_id', $user->id)->exists();
    
    if (!$studentExists) {
        Student::create([
            'user_account_id' => $user->id,
            'fname' => ucfirst(strtok($user->username, '.')),
            'lname' => ucfirst(strrev(strtok(strrev($user->username), '.'))),
            'mname' => '',
            'email' => $user->email,
            'contactInfo' => '09000000000',
            'degree_id' => 1,
        ]);
        echo "✓ Created student for: {$user->username}\n";
    } else {
        echo "- Student already exists for: {$user->username}\n";
    }
}

echo "\nTotal students now: " . Student::count() . "\n";
