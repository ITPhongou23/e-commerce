<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('users can log in with their name and password', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);

    $this->post('/login', [
        'name' => 'Test User',
        'password' => 'password123',
    ])
        ->assertRedirect('/')
        ->assertSessionHasNoErrors();

    $this->assertAuthenticatedAs($user);
});

test('the admin command creates an admin account with a generated password', function () {
    Artisan::call('admin:create', [
        '--name' => 'admin123',
        '--email' => 'admin@gmail.com',
    ]);

    $user = User::where('email', 'admin@gmail.com')->firstOrFail();
    preg_match('/One-time password: (.+)/', Artisan::output(), $matches);

    expect($user->role)->toBe(UserRole::Admin)
        ->and(Hash::check($matches[1] ?? '', $user->password))->toBeTrue();
});
