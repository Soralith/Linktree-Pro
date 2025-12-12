php artisan tinker

# User biasa
\App\Models\User::create([
    'name' => 'User Test',
    'email' => 'user@test.com',
    'role' => 'user',
    'password' => 'password123'
]);

# Admin
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@test.com',
    'role' => 'admin',
    'password' => 'admin123'
]);

exit
