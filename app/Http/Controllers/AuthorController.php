<?php


namespace App\Http\Controllers;

use App\Models\Author;
use App\Services\AuthorService;
use App\Http\Requests\AuthorRequest;
use Illuminate\Support\Facades\DB;

class AuthorController
{

    public function index()
    {
        $authors = Author::paginate(Author::PER_PAGE);

        return view('authors.index', compact('authors'))
            ->with('i', (request()->input('page', 1) - 1) * Author::PER_PAGE);
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(AuthorRequest $request, AuthorService $authorService)
    {
        $authorService->createAuthor($request->name, $request->first_name, $request->last_name);

        return redirect()->route('authors.index')
            ->with('success', 'Author created successfully.');
    }

    public function show(Author $author)
    {
        $authors = Author::findOrFail($author->id);

        return view('authors.show', compact('authors', 'author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(AuthorRequest $request, Author $author)
    {
        $author->update($request->all());

        return redirect()->route('authors.index')
            ->with('success', 'Author updated successfully');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('authors.index')
            ->with('success', 'Author deleted successfully');
    }

}
