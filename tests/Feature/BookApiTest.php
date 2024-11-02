<?php

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    Sanctum::actingAs($this->user, ['*']);
});

test('a book can be created via API', function () {
    Storage::fake('public');

    $category = Category::factory()->create();
    $coverImage = UploadedFile::fake()->image('cover.jpg');

    $response = $this->postJson('/api/books', [
        'title' => 'Test Book',
        'author' => 'Test Author',
        'description' => 'This is a test description.',
        'publication_year' => 2021,
        'cover_image' => $coverImage,
        'category_id' => $category->id,
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'message' => 'Book created successfully!',
            'book' => [
                'title' => 'Test Book',
                'author' => 'Test Author',
                'description' => 'This is a test description.',
                'publication_year' => 2021,
                'category_id' => $category->id,
                'user_id' => $this->user->id,
            ],
        ]);

    Storage::disk('public')->assertExists('cover_images/' . $coverImage->hashName());
});

test('a book can be updated via API', function () {
    $category = Category::factory()->create();
    $book = Book::factory()->create([
        'title' => 'Original Title',
        'author' => 'Original Author',
        'description' => 'Original Description',
        'publication_year' => 2020,
        'category_id' => $category->id,
        'user_id' => $this->user->id,
    ]);

    $response = $this->putJson("/api/books/{$book->id}", [
        'title' => 'Updated Title',
        'author' => 'Updated Author',
        'description' => 'Updated Description',
        'publication_year' => 2021,
        'category_id' => $category->id,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Book updated successfully!',
            'book' => [
                'title' => 'Updated Title',
                'author' => 'Updated Author',
                'description' => 'Updated Description',
                'publication_year' => 2021,
                'category_id' => $category->id,
            ],
        ]);

    $this->assertDatabaseHas('books', [
        'id' => $book->id,
        'title' => 'Updated Title',
        'author' => 'Updated Author',
        'description' => 'Updated Description',
        'publication_year' => 2021,
        'category_id' => $category->id,
    ]);
});

test('a book can be deleted via API', function () {
    $book = Book::factory()->create([
        'user_id' => $this->user->id,
    ]);

    $response = $this->deleteJson("/api/books/{$book->id}");

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Book deleted successfully!',
        ]);

    $this->assertDatabaseMissing('books', [
        'id' => $book->id,
    ]);
});

test('a book can be retrieved via API', function () {
    $book = Book::factory()->create([
        'title' => 'Test Book',
        'user_id' => $this->user->id,
    ]);

    $response = $this->getJson("/api/books/{$book->id}");

    $response->assertStatus(200)
        ->assertJson([
            'book' => [
                'title' => 'Test Book',
            ],
        ]);
});

test('books can be listed via API', function () {
    Book::factory()->count(3)->create([
        'user_id' => $this->user->id,
    ]);

    $response = $this->getJson('/api/books');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'author',
                    'description',
                    'publication_year',
                    'cover_image',
                    'category_id',
                    'user_id',
                ],
            ],
        ]);
});
