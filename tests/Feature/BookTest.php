<?php

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a book can be created', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $book = Book::create([
        'title' => 'Test Book',
        'author' => 'Test Author',
        'description' => 'This is a test description.',
        'publication_year' => 2021,
        'cover_image' => 'test_cover_image.jpg',
        'category_id' => $category->id,
        'user_id' => $user->id,
    ]);

    expect($book)->toBeInstanceOf(Book::class);
    expect($book->title)->toBe('Test Book');
    expect($book->author)->toBe('Test Author');
    expect($book->description)->toBe('This is a test description.');
    expect($book->publication_year)->toBe(2021);
    expect($book->cover_image)->toBe('test_cover_image.jpg');
    expect($book->category_id)->toBe($category->id);
    expect($book->user_id)->toBe($user->id);
});

test('a book can be updated', function () {
    $book = Book::factory()->create([
        'title' => 'Original Title',
    ]);

    $book->update([
        'title' => 'Updated Title',
    ]);

    expect($book->title)->toBe('Updated Title');
});

test('a book can be deleted', function () {
    $book = Book::factory()->create();

    $book->delete();

    expect(Book::find($book->id))->toBeNull();
});

test('a book can be retrieved', function () {
    $book = Book::factory()->create([
        'title' => 'Test Book',
    ]);

    $retrievedBook = Book::find($book->id);

    expect($retrievedBook)->not->toBeNull();
    expect($retrievedBook->title)->toBe('Test Book');
});

test('a book belongs to a user', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create([
        'user_id' => $user->id,
    ]);

    expect($book->user)->toBeInstanceOf(User::class);
    expect($book->user->id)->toBe($user->id);
});

test('a book belongs to a category', function () {
    $category = Category::factory()->create();
    $book = Book::factory()->create([
        'category_id' => $category->id,
    ]);

    expect($book->category)->toBeInstanceOf(Category::class);
    expect($book->category->id)->toBe($category->id);
});
