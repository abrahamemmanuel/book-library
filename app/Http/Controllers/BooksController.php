<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BooksController extends Controller
{
    public function store()
    {
        Book::create($this->validateRequest());

        return response(Response::HTTP_CREATED);
    }

    public function update(Book $book)
    {
        $book->update($this->validateRequest());
    }

    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required',
        ]);

    }
}
