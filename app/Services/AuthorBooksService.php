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
        if ($data->count() > 1) {
            $dataAB=$data->get();
            for($i=1; $i<$data->count(); $i++ ){
                $dataAB[$i]->delete();
            }

        }
        $data->update([
                'book_id' => $bookId,
                'author_id' => $authorId
            ]);
        return;
    }
}
