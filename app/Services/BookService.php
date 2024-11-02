<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookService
{
    public function createBook(Request $request)
    {
        $validator = $this->validateBook($request);

        if ($validator->fails()) {
            Log::error('Validation failed for creating book', ['errors' => $validator->errors()]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $this->prepareBookData($request);

        try {
            $book = Book::create($data);
            Cache::forget('books'); // Clear the cache when a new book is created
            Log::info('Cache cleared for books');
            return response()->json(['message' => 'Book created!', 'book' => $book], 201);
        } catch (\Exception $e) {
            Log::error('Error creating book', ['exception' => $e]);
            return response()->json(['message' => 'Error creating book'], 500);
        }
    }

    public function getBooks($categoryId = null)
    {
        try {
            $cacheKey = 'books' . ($categoryId ? '_category_' . $categoryId : '');

            return Cache::remember($cacheKey, 60, function () use ($categoryId, $cacheKey) {
                Log::info('Cache miss for key: ' . $cacheKey);
                $query = Book::where('user_id', Auth::id())->with('category');

                if ($categoryId) {
                    $query->where('category_id', $categoryId);
                }

                return $query->paginate(5);
            });
        } catch (\Exception $e) {
            Log::error('Error fetching books', ['exception' => $e]);
            return collect(); // Return an empty collection on error
        }
    }

    public function getBookById($id)
    {
        try {
            return Book::where('user_id', Auth::id())->with('category')->findOrFail($id);
        } catch (\Exception $e) {
            Log::error('Error fetching book by ID', ['exception' => $e]);
            throw $e; // Re-throw the exception to be handled by the controller
        }
    }

    public function updateBook(Request $request, $id)
    {
        try {
            $book = Book::where('user_id', Auth::id())->findOrFail($id);

            $validator = $this->validateBook($request);

            if ($validator->fails()) {
                Log::error('Validation failed for updating book', ['errors' => $validator->errors()]);
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $data = $this->prepareBookData($request, $book);

            $book->update($data);
            Cache::forget('books'); // Clear the cache when a book is updated
            Log::info('Cache cleared for books');

            return response()->json(['message' => 'Book updated!', 'book' => $book]);
        } catch (\Exception $e) {
            Log::error('Error updating book', ['exception' => $e]);
            return response()->json(['message' => 'Error updating book'], 500);
        }
    }

    public function deleteBook($id)
    {
        try {
            $book = Book::where('user_id', Auth::id())->findOrFail($id);

            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $book->delete();
            Cache::forget('books'); // Clear the cache when a book is deleted
            Log::info('Cache cleared for books');

            return response()->json(['message' => 'Book deleted!']);
        } catch (\Exception $e) {
            Log::error('Error deleting book', ['exception' => $e]);
            return response()->json(['message' => 'Error deleting book'], 500);
        }
    }

    private function validateBook(Request $request)
    {
        return Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'publication_year' => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
    }

    private function prepareBookData(Request $request, Book $book = null)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('cover_image')) {
            if ($book && $book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
        }

        return $data;
    }
}
