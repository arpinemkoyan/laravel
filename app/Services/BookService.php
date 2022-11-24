<?php


namespace App\Services;


use App\Models\Author;
use App\Models\Book;

class BookService
{

    public function createBook($name)
    {
        $book = new Book;
        $book = $book->fill(['name' => $name]);
        $book->save();

        return $book;
    }

    public function updateBook($bookId, $bookName)
    {
        return Book::where('id', '=', $bookId)
            ->update([
                'name' => $bookName,
            ]);
    }

}
