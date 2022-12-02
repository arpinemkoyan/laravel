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

    public function updateAuthorBook($bookId, $authors)
    {
        $data = AuthorBook::where('book_id', '=', $bookId);
        foreach ($authors as $author) {
            $data->update([
                'book_id' => $bookId,
                'author_id' => $author->id
            ]);
        }
        return;
    }
}
