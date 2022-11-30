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
        $data = AuthorBook::where('book_id', '=', $bookId);
        $data->delete();

        $data->fill([
            'book_id' => $bookId,
            'author_id' => $authorId
        ]);
        $data->save;
        return;
    }
}
