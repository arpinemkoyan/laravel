<?php


namespace App\Services;


use App\Models\Author;

class AuthorService
{
    public function createAuthor($name, $first_name, $last_name)
    {
        $author = new Author;
        $author = $author->fill([
            'name' => $name,
            'first_name' => $first_name,
            'last_name' => $last_name
        ]);
        $author->save();
        return $author;
    }


}
