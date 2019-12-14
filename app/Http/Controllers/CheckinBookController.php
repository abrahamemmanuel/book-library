<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Support\Facades\Auth;

class CheckinBookController extends Controller
{
    public function __construct()
    {$this->middleware('auth');
    }
    public function store(Book $book)
    {
        if (Auth::check()) {
            try {
                $book->checkin(auth()->user());
            } catch (\Exception $e) {
                return response([], 404);
            }
        }

    }
}
