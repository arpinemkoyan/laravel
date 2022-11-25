<?php


namespace App\Services;


use App\Models\Author;

class AuthorService
{
    public function createAuthor($firstName, $lastName){
        $author = new Author;
        $author= $author->fill([
            'first_name' => $firstName,
            'last_name' => $lastName]);
        $author->save();
        return $author;
    }

    public  function selectAuthor($firstName, $lastName){
        return Author::select('id')
            ->where('first_name', '=', $firstName)
            ->where('last_name', '=', $lastName);
    }

}
