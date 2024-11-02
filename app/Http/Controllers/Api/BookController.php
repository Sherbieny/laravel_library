<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    //Test controller

    public function index()
    {
        $books = Book::where('user_id', Auth::id())->with('category')->get();


        return response()->json([
            'message' => 'Hello Api World!',
            'books' => $books,
        ]);
    }

    //API controller action

    public function store(Request $request)
    {
        //TODO: Implement store method
        return response()->json([
            'message' => 'Book created!',
        ]);
    }

    public function show($id)
    {
        //TODO: Implement show method

        return response()->json([
            'message' => 'Book found!',
        ]);
    }

    public function update(Request $request, $id)
    {
        //TODO: Implement update method

        return response()->json([
            'message' => 'Book updated!',
        ]);
    }

    public function destroy($id)
    {
        //TODO: Implement destroy method

        return response()->json([
            'message' => 'Book deleted!',
        ]);
    }
}
