<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookList extends Controller
{
    public function index()
    {
        $books = Book::with('kategori')->get();
        return view('books/books_lists', ["books" => $books]);
    }
}
