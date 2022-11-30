<?php


namespace App\Services;


use App\Models\Author;

class AuthorService
{
    public function createAuthor($name)
    {
        $author = new Author;
        $author = $author->fill([
            'name' => $name]);
        $author->save();
        return $author;
    }


}
