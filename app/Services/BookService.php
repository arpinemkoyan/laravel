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
        foreach ($ids as $authorId) {
            $authorBooksService->createAuthorBook($book->id, $authorId);
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
