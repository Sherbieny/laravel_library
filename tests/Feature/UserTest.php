<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a user can be created', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'testuser@example.com',
        'password' => bcrypt('password'),
    ]);

    expect($user)->toBeInstanceOf(User::class);
    expect($user->name)->toBe('Test User');
    expect($user->email)->toBe('testuser@example.com');
});

test('a user can be updated', function () {
    $user = User::factory()->create([
        'name' => 'Original Name',
    ]);

    $user->update([
        'name' => 'Updated Name',
    ]);

    expect($user->name)->toBe('Updated Name');
});

test('a user can be deleted', function () {
    $user = User::factory()->create();

    $user->delete();

    expect(User::find($user->id))->toBeNull();
});

test('a user can be retrieved', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
    ]);

    $retrievedUser = User::find($user->id);

    expect($retrievedUser)->not->toBeNull();
    expect($retrievedUser->name)->toBe('Test User');
});

// Add more tests if there are relationships or additional functionalities