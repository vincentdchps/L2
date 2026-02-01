<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        $books = Book::with('author')->paginate();

        return view('books.index', compact('books'));
    }

    public function show(int $id)
    {
        $book = Book::with('author')->find($id);

        return view('books.show', compact('book'));
    }
}
