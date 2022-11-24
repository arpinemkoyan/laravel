<?php


namespace App\Services;


use App\Models\AuthorBook;

class AuthorBooksService
{
    public function createAuthorBook($bookId, $authorId)
    {
        return AuthorBook::create([
            'book_id' => $bookId,
            'author_id' => $authorId
        ]);
    }

    public function updateAuthorBook($bookId, $authorId)
    {
        return AuthorBook::where('book_id', '=', $bookId)
            ->update([
                'book_id' => $bookId,
                'author_id' => $authorId
            ]);
    }
}
