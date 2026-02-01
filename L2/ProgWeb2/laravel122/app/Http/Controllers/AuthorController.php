<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function show(int $id)
    {
        $author = Author::with('books')->find($id);

        return view('authors.show', compact('author'));
    }
}
