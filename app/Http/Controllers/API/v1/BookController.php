<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\BookStoreRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        return response()->json([
            'books' => Book::get(['id', 'title', 'author'])
        ], 200);
    }

    public function show(Book $book){
        return response()->json([
            'book' => $book
        ]);
    }

    public function store(BookStoreRequest $request){
        $book = Book::create($request->all());
        return response()->json([
            'book' => $book
        ], 201);
    }

    public function destroy(Book $book){
        $book->delete();
        return response()->json(null, 204);
    }

    public function update(BookStoreRequest $request, Book $book){
        $book->update($request->all());
        return response()->json([
            'book' => $book
        ], 200);
    }
}
