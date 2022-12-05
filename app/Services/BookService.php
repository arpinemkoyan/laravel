<?php


namespace App\Services;


use App\Models\Book;

class BookService
{


    public function createBook($name, $ids)
    {
        $authorBooksService = new AuthorBooksService;
        $book = new Book;
        $book = $book->fill(['name' => $name]);
        $book->save();
        $idB = $book->id;
        foreach ($ids as $idA) {
            $authorBooksService->createAuthorBook($idB, $idA);
        }

        return $book;
    }

    public function updateBook($bookId, $bookName)
    {
        $books = Book::where('id', '=', $bookId)
            ->update(['name' => $bookName]);

        return $books;
    }

}
