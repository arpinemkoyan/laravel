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

    public function updateAuthorBook($bookId, $authorsId)
    {
        $data = AuthorBook::where('book_id', '=', $bookId);
        $data->delete();
        foreach ($authorsId as $author_id) {
            $data->insert([
                'book_id' => $bookId,
                'author_id' => $author_id
            ]);
        }
        return;
    }
}
