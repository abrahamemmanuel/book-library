<?php

namespace Tests\Unit;

use App\Author;
use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @test
     */
    public function an_author_id_is_recorded()
    {
        Book::create([
         'title' => 'Cool Code',
         'author_id' => 1
        ]);

        $this->assertCount(1, Book::all());
    }
}
