<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use App\Models\Category;
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
        $categories = Category::all();
        $books = $this->bookService->getBooks($request->category_id);
        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $response = $this->bookService->createBook($request);
        if ($response->status() == 201) {
            return redirect()->route('books.index')->with('success', 'Book created successfully!');
        } else {
            Log::error('Error creating book', ['response' => $response]);
            return redirect()->back()->withErrors($response->getData()->errors)->withInput();
        }
    }

    public function show($id)
    {
        try {
            $book = $this->bookService->getBookById($id);
            return view('books.show', compact('book'));
        } catch (\Exception $e) {
            Log::error('Error fetching book by ID', ['exception' => $e]);
            return redirect()->route('books.index')->with('error', 'Error fetching book.');
        }
    }

    public function edit($id)
    {
        try {
            $book = $this->bookService->getBookById($id);
            $categories = Category::all();
            return view('books.edit', compact('book', 'categories'));
        } catch (\Exception $e) {
            Log::error('Error fetching book by ID for edit', ['exception' => $e]);
            return redirect()->route('books.index')->with('error', 'Error fetching book.');
        }
    }

    public function update(Request $request, $id)
    {
        $book = $this->bookService->getBookById($id);

        // Authorization check
        if ($book->user_id !== Auth::id()) {
            return redirect()->route('books.index')->with('error', 'Unauthorized action.');
        }

        $response = $this->bookService->updateBook($request, $id);
        if ($response->status() == 200) {
            return redirect()->route('books.index')->with('success', 'Book updated successfully!');
        } else {
            Log::error('Error updating book', ['response' => $response]);
            return redirect()->back()->withErrors($response->getData()->errors)->withInput();
        }
    }

    public function destroy($id)
    {
        $book = $this->bookService->getBookById($id);

        // Authorization check
        if ($book->user_id !== Auth::id()) {
            return redirect()->route('books.index')->with('error', 'Unauthorized action.');
        }

        $response = $this->bookService->deleteBook($id);
        if ($response->status() == 200) {
            return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
        } else {
            Log::error('Error deleting book', ['response' => $response]);
            return redirect()->back()->with('error', 'Failed to delete the book.');
        }
    }
}
