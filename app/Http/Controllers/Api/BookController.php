<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(Request $request)
    {
        try {
            $books = $this->bookService->getBooks($request->category_id);
            return response()->json($books, 200);
        } catch (\Exception $e) {
            Log::error('Error fetching books', ['exception' => $e]);
            return response()->json(['message' => 'Error fetching books'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $response = $this->bookService->createBook($request);
            if ($response->status() == 201) {
                return response()->json(['message' => 'Book created successfully!', 'book' => $response->getData()->book], 201);
            } else {
                return response()->json(['errors' => $response->getData()->errors], 422);
            }
        } catch (\Exception $e) {
            Log::error('Error creating book', ['exception' => $e]);
            return response()->json(['message' => 'Error creating book'], 500);
        }
    }

    public function show($id)
    {
        try {
            $book = $this->bookService->getBookById($id);
            return response()->json(['book' => $book], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching book by ID', ['exception' => $e]);
            return response()->json(['message' => 'Error fetching book'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $book = $this->bookService->getBookById($id);

            // Authorization check
            if ($book->user_id !== Auth::id()) {
                return response()->json(['message' => 'Unauthorized action'], 403);
            }

            $response = $this->bookService->updateBook($request, $id);
            if ($response->status() == 200) {
                return response()->json(['message' => 'Book updated successfully!', 'book' => $response->getData()->book], 200);
            } else {
                return response()->json(['errors' => $response->getData()->errors], 422);
            }
        } catch (\Exception $e) {
            Log::error('Error updating book', ['exception' => $e]);
            return response()->json(['message' => 'Error updating book'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $book = $this->bookService->getBookById($id);

            // Authorization check
            if ($book->user_id !== Auth::id()) {
                return response()->json(['message' => 'Unauthorized action'], 403);
            }

            $response = $this->bookService->deleteBook($id);
            if ($response->status() == 200) {
                return response()->json(['message' => 'Book deleted successfully!'], 200);
            } else {
                return response()->json(['message' => 'Failed to delete the book'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting book', ['exception' => $e]);
            return response()->json(['message' => 'Error deleting book'], 500);
        }
    }
}
